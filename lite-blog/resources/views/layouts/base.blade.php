<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
</head>
<body>
<main>
    @include('layouts.navigation')
    @yield('content')
</main>

</body>
<script>
    let multiselectBlock = document.querySelectorAll(".form__multiselect");

    multiselectBlock.forEach((parent) => {
        let label = parent.querySelector(".form__multiselect__label");
        let select = parent.querySelector(".form__multiselect__select");
        let selectedOptionsMap = [];

        let hiddenInput = document.getElementById("selectedAuthors");

        select.addEventListener("change", function(e) {
            let selectedOptions = this.selectedOptions;

            for (let option of selectedOptions) {
                let value = option.value;

                if (!selectedOptionsMap.includes(value)) {
                    let button = document.createElement("button");
                    button.type = "button";
                    button.className = "btn_multiselect";
                    button.textContent += value;

                    button.onclick = () => {
                        option.selected = false;
                        button.remove();
                        selectedOptionsMap.splice(selectedOptionsMap.indexOf(value), 0);
                        console.log(hiddenInput)
                        updateHiddenInput();
                    };

                    label.append(button);
                    selectedOptionsMap.push(value);
                    updateHiddenInput();
                }
            }
        });

        function updateHiddenInput() {
            hiddenInput.value = selectedOptionsMap.join(",");
        }
    });


</script>
<style>
    .form {
        position: relative;
        min-height: 88px;
    }
    .form__multiselect__label,
    .form input {
        position: relative;
        width: 100%;
        display: block;
        min-height: 46px;
        border: 1px solid #cdd6f3;
        box-sizing: border-box;
        border-radius: 8px;
        padding: 12px 40px 10px 16px;
        font-size: 14px;
        color: #a8acc9;
        outline-color: #cdd6f3;
    }
    .form__multiselect__label::placeholder,
    .form input::placeholder {
        color: #a8acc9;
    }
    .form__multiselect__label:hover,
    .form input:hover {
        box-shadow: 0 0 2px rgba(0, 0, 0, .16);
    }
    .form__multiselect__label:focus,
    .form input:focus {
        box-shadow: 0 0 2px rgba(0, 0, 0, .16);
    }
    .form__multiselect__label {
        padding-right: 60px;
    }
    .form__multiselect__label:after {
        content: "";
        position: absolute;
        right: 14px;
        top: 15px;
        width: 6px;
        height: 16px;
        background: url("data:image/svg+xml, %3Csvg width='6' height='16' viewBox='0 0 6 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M3 0L6 5H0L3 0Z' fill='%23A8ACC9'/%3E%3Cpath d='M3 16L6 11H0L3 16Z' fill='%23A8ACC9'/%3E%3C/svg%3E") 50% 50% no-repeat;
    }
    .form__multiselect {
        position: relative;
        width: 100%}
    .form__multiselect__select {
        position: absolute;
        top: calc(100% - 2px);
        left: 0;
        width: 100%;
        border: 2px solid #cdd6f3;
        border-bottom-right-radius: 2px;
        border-bottom-left-radius: 2px;
        box-sizing: border-box;
        outline-color: #cdd6f3;
        z-index: 6;
    }
    .form__multiselect__select[multiple] {
        overflow-y: auto;
    }
    .form__multiselect__select option {
        display: block;
        padding: 8px 16px;
        width: calc(370px - 32px);
        cursor: pointer;
    }
    .form__multiselect__select option:checked {
        background-color: #eceff3;
    }
    .form__multiselect__select option:hover {
        background-color: #d5e8fb;
    }
    .form__multiselect__label button {
        position: relative;
        padding: 7px 34px 7px 8px;
        background: #ebe4fb;

        border-radius: 40px;
        margin-right: 9px;
        margin-bottom: 10px;
    }
    .form__multiselect__label button:focus,
    .form__multiselect__label button:hover {
        background-color: #dbd1ee;
    }
    .form__multiselect__label button:after {
        content: "";
        position: absolute;
        top: 7px;
        right: 10px;
        width: 16px;
        height: 16px;
        background: url("data:image/svg+xml, %3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M19.4958 6.49499C19.7691 6.22162 19.7691 5.7784 19.4958 5.50504C19.2224 5.23167 18.7792 5.23167 18.5058 5.50504L12.5008 11.5101L6.49576 5.50504C6.22239 5.23167 5.77917 5.23167 5.50581 5.50504C5.23244 5.7784 5.23244 6.22162 5.50581 6.49499L11.5108 12.5L5.50581 18.505C5.23244 18.7784 5.23244 19.2216 5.50581 19.495C5.77917 19.7684 6.22239 19.7684 6.49576 19.495L12.5008 13.49L18.5058 19.495C18.7792 19.7684 19.2224 19.7684 19.4958 19.495C19.7691 19.2216 19.7691 18.7784 19.4958 18.505L13.4907 12.5L19.4958 6.49499Z' fill='%234F5588'/%3E%3C/svg%3E") 50% 50% no-repeat;
        background-size: contain;
    }
    .form__multiselect__checkbox__label {
        position: absolute;
        top: 1px;
        left: 2px;
        width: 100%;
        height: 44px;
        cursor: pointer;
        z-index: 3;
    }
    .form__multiselect__select {
        display: none;
        cursor: pointer;
    }
    input.form__multiselect__checkbox {
        position: absolute;
        right: 0;
        top: 0;
        width: 40px;
        height: 40px;
        border: none;
        opacity: 0;
    }
    .form__multiselect__checkbox:checked~.form__multiselect__select {
        display: block;
    }
    .form__multiselect__checkbox:checked~.form__multiselect__checkbox__label {
        width: 40px;
        left: initial;
        right: 4px;
        background: #fff url("data:image/svg+xml, %3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M19.4958 6.49499C19.7691 6.22162 19.7691 5.7784 19.4958 5.50504C19.2224 5.23167 18.7792 5.23167 18.5058 5.50504L12.5008 11.5101L6.49576 5.50504C6.22239 5.23167 5.77917 5.23167 5.50581 5.50504C5.23244 5.7784 5.23244 6.22162 5.50581 6.49499L11.5108 12.5L5.50581 18.505C5.23244 18.7784 5.23244 19.2216 5.50581 19.495C5.77917 19.7684 6.22239 19.7684 6.49576 19.495L12.5008 13.49L18.5058 19.495C18.7792 19.7684 19.2224 19.7684 19.4958 19.495C19.7691 19.2216 19.7691 18.7784 19.4958 18.505L13.4907 12.5L19.4958 6.49499Z' fill='%234F5588'/%3E%3C/svg%3E") 50% 50% no-repeat;
    }
</style>
</html>
