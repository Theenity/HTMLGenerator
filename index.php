<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <title>HTMLHelper</title>
    </head>
    <body>
	<?php
	
	include("./HTMLHelper.php");
	
	// div container
	$div = new ElementDOMComposite('div', array('class' => 'container'));
	
	// titre
	$h1 = new ElementDOMSimple('h1', null, $div);
	$h1->setContenu("Hello World");
	$h1->appendContenu(" ! :)");
	
	// paragraphe
	$p = new ElementDOMSimple('p', array('class' => 'text-centered'), $div);
	$p->setContenu("Un petit snippet utilisant HTMLHelper.");
	
	// ancre
	$a = new ElementDOMSimple('a', array('href' => 'http://www.timothee-scherrer.fr', 'target' => '_blank'), $div);
	$a->setContenu("Lien vers mon site web");
	
	// affichage de l'arbre à partir du div container
	$div->afficherArbreDOM();
		
	?>
    </body>
</html>
