function addIngredient(){

let container = document.getElementById("ingredients");

let row = document.createElement("div");

row.classList.add("ingredient-row");

row.innerHTML = `
<select name="aines_id[]">
<option value="">Valitse aines</option>
</select>

<input type="text" name="maara[]" placeholder="Määrä">
`;

container.appendChild(row);

}

