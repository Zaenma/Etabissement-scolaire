<?php

function card(string $legende, int $donnee, string $uri, string $class): string
{
    return ' 
            <div class="card text-left">
                <div class="card-header">
                <h5 class="font-weight-bold">' . $legende . '</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">' . $donnee . '</p>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="' . $uri . '" class="btn btn-outline-' . $class . '">Voir les details</a>
                    </div>
                </div>
            </div>';
}


function input(string $type, string $name, string $label = null, string $class = "form-control", string $value = null): string
{
    if ($type === 'submit') {
        $value = "Enregistrer";
    }

    if ($type != 'file') {
        $required = "required";
    }
    return '
        <div class="form-group">
            <label for="">' . $label . '</label>
            <input type="' . $type . '" class="' . $class . '" name="' . $name . '" id="" value="' . $value . '" ' . $required . ' autocomplete="OFF"></div>
        ';
}

function button_submit(string $name, string $class, string $value)
{
    return '
        <div class="form-group">
            <input type="submit" class="' . $class . '" name="' . $name . '" id="id-' . $name . '" value="' . $value . '">
        </div>
        ';
}

function inputSelect(string $label, $name)
{
    $variable = ["Musulmane", "Chretien"];

    foreach ($variable as $key) {
        $option = '<option>' . $key . '</option>';
    }


    return '
    <div class="form-group">
        <label for="">' . $label . '</label>
        <select class="form-control" name="' . $name . '" id="">
            <option selected>--------</option>
                ' . $option . '
        </select>
    </div>
    ';
}


function modal($modalIdentifiant, $message)
{
    return '
    <div class="modal fade" id="' . $modalIdentifiant . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>' . $message . '</p>
                </div>
            </div>
        </div>
    </div>
        ';
}
