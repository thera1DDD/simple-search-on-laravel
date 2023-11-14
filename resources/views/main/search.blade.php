<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск записей</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        label {
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"] {
            padding: 12px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 12px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .result-container {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .result-item {
            flex: 1 1 calc(50% - 16px);
            padding: 16px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 16px;
        }

        @media only screen and (min-width: 768px) {
            form {
                max-width: 400px;
                margin: 0 auto;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <form action="{{ route('search') }}" method="get">
        @csrf
        <label for="searchText">Введите текст комментария (минимум 3 символа):</label>
        <input type="text" id="searchText" name="searchText" minlength="3" required>
        <button type="submit">Найти</button>
    </form>

    @if(isset($results))
        <div class="result-container">
            @foreach($results as $result)
                <div class="result-item">
                    <h2>{{ $result->post->title }}</h2>
                    <p>{{ $result->body }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>

</body>
</html>
