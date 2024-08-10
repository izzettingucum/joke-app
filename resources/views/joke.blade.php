<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Joke Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .joke-container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        #get-joke {
            margin-top: 1rem;
        }
        #joke-display {
            margin-top: 2rem;
        }
    </style>
</head>
<body>
<div class="joke-container">
    <h1 class="mb-4">Random Joke Generator</h1>

    <label for="joke-category" class="form-label">Choose a joke category:</label>
    <select id="joke-category" class="form-select">
        @foreach($jokeCategories as $category)
            <option value="{{ $category }}">{{ $category }}</option>
        @endforeach
    </select>

    <div class="form-group">
        <label for="joke-blacklist" class="form-label">Choose blacklist categories:</label>
        <div class="d-flex flex-wrap">
            @foreach($blackLists as $value)
                <div class="form-check me-3">
                    <input class="form-check-input" type="checkbox" name="blacklist-categories[]" id="blacklist-{{ $value }}" value="{{ $value }}">
                    <label class="form-check-label" for="blacklist-{{ $value }}">
                        {{ $value }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group">
        <label for="joke-type" class="form-label">Choose a joke type:</label>
        <div class="d-flex flex-wrap">
            @foreach($jokeTypes as $type)
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="joke-type" id="joke-type-{{ $type }}" value="{{ $type }}">
                    <label class="form-check-label" for="joke-type-{{ $type }}">
                        {{ $type }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <button id="get-joke" class="btn btn-primary btn-lg w-100">Get Joke</button>

    <div id="joke-display" class="alert alert-light mt-4">
        <h2>Your Joke:</h2>
        <p id="joke-text"></p>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#get-joke').click(function() {
            const category = $('#joke-category').val();

            const type = $('input[name="joke-type"]:checked').val();

            const blacklistCategories = $('input[name="blacklist-categories[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            $.ajax({
                url: '/get-joke',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    category: category,
                    type: type,
                    blacklist: blacklistCategories
                },
                success: function(response) {
                    // Gelen yanıtı işleyin
                    if (response.type === 'single') {
                        $('#joke-text').text(response.joke);
                    } else {
                        $('#joke-text').html('<strong>' + response.setup + '</strong><br>' + response.delivery);
                    }
                }
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
