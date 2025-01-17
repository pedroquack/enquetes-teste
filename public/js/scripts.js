window.addEventListener("load", function () {

    const addOptionButton = document.getElementById("add-option");
    var formDataOptions = document.getElementById("form-data-options");
    addOptionButton.addEventListener("click", function () {
        const optionCount =
            formDataOptions.querySelectorAll(".form-group").length + 1;
        const newOption = document.createElement("div");
        newOption.classList.add("form-group");

        newOption.innerHTML = `
            <label for="title">Opção ${optionCount}</label>
            <input type="text" class="input-new-option" name="options[]" id="title">
            <button type="button" id="remove-option" class="remove-option">Remover</button>
        `;

        formDataOptions.appendChild(newOption);
        formDataOptions = document.getElementById("form-data-options");
    });

    formDataOptions.addEventListener("click", function (event){
        if(event.target.classList.contains("remove-option")){
            const option = event.target.closest('.form-group');
            formDataOptions.removeChild(option);
        }
    });
});
