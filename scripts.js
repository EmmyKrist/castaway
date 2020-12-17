function loadFileInto(fromFile, whereTo) {

	// creating a new XMLHttpRequest object
	ajax = new XMLHttpRequest();

	console.log("Filename: " + fromFile);

	// defines the GET/POST method, source, and async value of the AJAX object
	ajax.open("GET", fromFile, true);

	// provides code to do something in response to the AJAX request
	ajax.onreadystatechange = function() {
		if ((this.readyState == 4) && (this.status == 200)) {
			console.log("AJAX response: " + this.responseText);

			if (this.responseText != 0) {

				responseArray = JSON.parse(this.responseText);


				responseHTML = "";
				for (x = 0; x < responseArray.length; x++) {
					responseHTML += "<li>" + responseArray[x].content + "</li>";
				}
				document.querySelector(whereTo).innerHTML = responseHTML;
			} else {
				console.log("Error: no recipe/list found.");
			}

		} else if ((this.readyState == 4) && (this.status != 200)) {
			console.log("Error: " + this.responseText);
		}
	}

	// initiate request and wait for response
	ajax.send();

}
 /*
function Story(storyTitle, storyImageSrc, storyContributors, storyID) {
	this.title = storyTitle;
	this.imgSrc = storyImageSrc;
	this.contributor = storyContributors;
  this.id = storyID;
  */
  
  function Story(storyTitle, storyImageSrc, storyOption1Filename, storyOption2Filename, storyOption3Filename, storyContributor){
  this.title = storyTitle;
  this.imgSrc = storyImageSrc;
  this.fileIngredients = storyIngredientsFilename;
  this.fileEquipment = recipeEquipmentFilename;
  this.fileDirections = recipeDirectionsFilename;
  this.contributor = recipeContributor;

	this.displayRecipe = function() {
		layoutTitle = document.querySelectorAll("INSERTTITLECSS");
		layoutTitle[0].innerHTML = this.title;

		layoutContributor = document.querySelectorAll("INSERTAUTHORCSS");
		layoutContributor[0].innerHTML = this.contributor;

		//image not funtional, don't forget to fix
		//document.getElementById("image")= "url(" + this.imgSrc" + )";
		document.getElementById("image").src = this.imgSrc;

		layoutFilename = "functions.php?id=" + this.id + "&list=directions";
		loadFileInto(layoutFilename);
	}
}




 layoutFilename = "Option 1/" + this.fileIngredients;
    loadFileInto(layoutFilename, "ingredients");
    
    layoutFilename = "recipes/" + this.fileEquipment;
    loadFileInto(layoutFilename, "equipment");
    
     layoutFilename = "recipes/" + this.fileDirections;
    loadFileInto(layoutFilename, "directions");
  }
}

Lasagna = new Recipe(
"Lasagna",
"https://images.unsplash.com/photo-1551892269-860b1e482f98?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80",
"lasagna-ingredients.html",
"lasagna-equipment.html",
"lasagna-directions.html",
"Contributed by Emmy Krist"
);




/*


//place different pages below
Homepage = new Story(
	"Page 1",
	"imagehere",
	"Written by Brandon Salisbury, and Katie Pry, and Emmy Krist"
);
decision1 = new Story(
	"page3",
	"imagehere",
	"Written by Brandon Salisbury, and Katie Pry, and Emmy Krist",
);
decision2 = new Story(
	"page4",
	"imagehere",
	"Written by Brandon Salisbury, and Katie Pry, and Emmy Krist",
);
decision3 = new Story(
	"page5",
	"imagehere",
	"Written by Brandon Salisbury, and Katie Pry, and Emmy Krist",
);
decision4 = new Story(
	"page6",
	"imagehere",
	"Written by Brandon Salisbury, and Katie Pry, and Emmy Krist",
);
*/


