
<style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            background-color: #d9534f;
            color: #fff;
            border: 1px solid #d9534f;
            border-radius: 4px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #c9302c;
            border-color: #ac2925;
        }
    </style>

<div class="container">
    <div class="text-center form-container">
        <h2>Trocar Senha</h2>
        <form method="post" action="">
            <label for="password">Nova Senha:</label>
            <input type="password" name="password" class="form-control" required>
            <label for="confirm_password">Confirme a Nova Senha:</label>
            <input type="password" name="confirm_password" class="form-control" required>
            <button class="button" type="submit" class="btn btn-danger">Trocar Senha</button>
        </form>
    </div>
</div>