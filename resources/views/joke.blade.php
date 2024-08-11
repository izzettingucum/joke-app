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
            margin: 0;
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

        .form-label {
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .form-check-input {
            margin-right: 0.5rem;
        }

        .form-check-label {
            font-size: 1rem;
        }

        #get-joke {
            margin-top: 1rem;
            font-size: 1.2rem;
            padding: 0.75rem 1.5rem;
        }

        #joke-display {
            margin-top: 2rem;
            background: #f0f0f0;
            border: 1px solid #ddd;
            padding: 1rem;
            border-radius: 5px;
            text-align: left;
        }

        #joke-display h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
<div class="joke-container">
    <h1 class="mb-4">Random Joke Generator</h1>

    <div class="form-group">
        <label for="joke-categories" class="form-label">Choose joke categories:</label>
        <div class="d-flex flex-wrap">
            @foreach($jokeCategories as $category)
                <div class="form-check me-3">
                    <input class="form-check-input" type="checkbox" name="joke-categories[]" id="joke-category-{{ $category }}" value="{{ $category }}">
                    <label class="form-check-label" for="joke-category-{{ $category }}">
                        {{ $category }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group mt-3">
        <label for="joke-blacklist" class="form-label">Choose blacklist categories:</label>
        <div class="d-flex flex-wrap">
            @foreach($blackLists as $value)
                <div class="form-check me-3">
                    <input class="form-check-input" type="checkbox" name="blacklist-categories[]"
                           id="blacklist-{{ $value }}" value="{{ $value }}">
                    <label class="form-check-label" for="blacklist-{{ $value }}">
                        {{ $value }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group mt-3">
        <label for="joke-type" class="form-label">Choose a joke type:</label>
        <div class="d-flex flex-wrap">
            @foreach($jokeTypes as $type)
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="joke-type" id="joke-type-{{ $type }}"
                           value="{{ $type }}">
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
    $(document).ready(function () {
        $('#get-joke').click(function () {
            const jokeCategories = $('input[name="joke-categories[]"]:checked').map(function () {
                return $(this).val();
            }).get();

            const blacklistCategories = $('input[name="blacklist-categories[]"]:checked').map(function () {
                return $(this).val();
            }).get();

            const type = $('input[name="joke-type"]:checked').val();

            $.ajax({
                url: '/joke',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    category: jokeCategories.length > 0 ? jokeCategories : ['any'],
                    blacklist: blacklistCategories.length > 0 ? blacklistCategories : null,
                    type: type ?? null,
                },
                success: function (response) {
                    if (response.type === 'twopart') {
                        const setup = response.setup;
                        const delivery = response.delivery;

                        $('#joke-text').html(`
                            <strong>Question:</strong> ${setup}<br>
                            <strong>Answer:</strong> ${delivery}
                        `);
                    }

                    else {
                        const joke = response.joke;

                        $('#joke-text').html(`
                            <strong>Joke:</strong> ${joke}
                        `);
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = '';
                        $.each(errors, function (key, messages) {
                            errorMessage += `${messages.join(', ')}\n`;
                        });
                        alert(errorMessage);
                    } else {
                        alert('Bir hata oluştu. Lütfen tekrar deneyin.');
                    }
                }
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
