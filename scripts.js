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
					responseHTML += "<li>" + responseArray[x] + "</li>";
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

function Story(storyTitle, storyImageSrc, storyContributors) {
	this.title = storyTitle;
	this.imgSrc = storyImageSrc;
	this.contributor = storyContributors;

	this.displayRecipe = function() {
		layoutTitle = document.querySelectorAll("INSERTTITLECSS");
		layoutTitle[0].innerHTML = this.title;

		layoutContributor = document.querySelectorAll("INSERTAUTHORCSS");
		layoutContributor[0].innerHTML = this.contributor;

		//image not funtional, don't forget to fix
		//document.getElementById("image")= "url(" + this.imgSrc" + )";
		document.getElementById("image").src = this.imgSrc;

		layoutFilename = "INSERTFILENAME";
		loadFileInto(layoutFilename);
	}
}
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

window.onload = function() {}