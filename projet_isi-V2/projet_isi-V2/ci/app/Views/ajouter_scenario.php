    <title>Créer un Scénario</title>
    <style>
        .container {
            width: 50%;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.2s;
            margin: 0 auto;
            display: block;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid transparent;
            border-radius: 4px;
            text-align: center;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
    </style>
    <div class="container">
        <h2>Créer un Scénario</h2>

        <form method="post" action= <?= base_url('index.php/scenario/ajouter_scenario') ?> enctype="multipart/form-data">
            <div class="form-group">
                <label for="intitule">Intitulé:</label>
                <input type="text" id="intitule" name="intitule" value="" required>
            </div>

            <div class="form-group">
                <label for="descr">Description Scénario:</label>
                <input type="text" id="descr" name="descr" value="" required>
            </div>

            <div class="form-group">
                <label for="code">code:</label>
                <input type="text" id="code" name="code" value="" required>
            </div>

            <div class="form-group">
                <label for="fichier">Image:</label>
                <input type="file" id="fichier" name="fichier" required>
            </div>

            <div class="form-group">
                <label for="validite">Etat :</label>
                <select id="etat" name="etat">
                    <option value="P">Publié</option>
                    <option value="C">Caché</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="Créer un nouveau scénario">

            </div>
        </form>
    </div>
