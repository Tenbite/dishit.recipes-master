<?php
	function insertRecipe() {
		global $db;

		extract($_REQUEST);
		
		$query = "INSERT INTO recipes(user_id, title, description, ingredients, directions, approved, created, modified) 
                                values (
                                    :user_id,
                                    :title,
                                    :description,
                                    :ingredients,
                                    :directions,
                                    TRUE, 
                                    NOW(),
                                    NOW())"; // approve by default for testing
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $_SESSION['user_id']);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':ingredients', $ingredients);
        $statement->bindValue(':directions', $directions);

        $statement->execute();
        $statement->closeCursor();

        if($statement->rowCount()==1){
            return $db->lastInsertId();
        } else {
            return $statement->rowCount();
        }
	} //end insertRecipe

    function getRecipeList() {
        global $db;

        $query = "Select r.id, r.title, u.username from recipes r inner join users u on u.id = r.user_id";

        $statement = $db->prepare($query);
        //Parameters processed here
        $statement->execute();

        $results = $statement->fetchAll();

        $statement->closeCursor();

        return $results;
    } //end getRecipeList

    function getRecipeDetails($id){
        global $db;

        $query = "Select r.title, r.ingredients,r.description,r.directions,r.modified,u.username from recipes r inner join users u on u.id = r.user_id where r.id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        //Parameters processed here
        $statement->execute();

        $results = $statement->fetch();

        $statement->closeCursor();

        return $results;
    } // end getRecipeDetails

    function getRecipeTitle($id){
    global $db;

    $query = "Select title From recipes
						Where id=:id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);

    $statement->execute();

    $results = $statement->fetch();

    $statement->closeCursor();
    return $results['title'];
    }

    function getRecipeDescription($id){
    global $db;

    $query = "Select description From recipes
						Where id=:id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);

    $statement->execute();

    $results = $statement->fetch();

    $statement->closeCursor();
    return $results['description'];
    }



    function getRecipeIngredients($id){
    global $db;

    $query = "Select ingredients From recipes
						Where id=:id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);

    $statement->execute();

    $results = $statement->fetch();

    $statement->closeCursor();
    return $results['ingredients'];
    }

    function getRecipeDirections($id){
    global $db;

    $query = "Select directions From recipes
						Where id=:id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);

    $statement->execute();

    $results = $statement->fetch();

    $statement->closeCursor();
    return $results['directions'];
    }



    function getRecipeRatings($recipe_id){
        global $db;

        $query = "Select ra.rating from ratings ra where ra.recipe_id=:recipe_id";

        $statement = $db->prepare($query);
        $statement->bindValue(':recipe_id', $recipe_id);
        //Parameters processed here
        $statement->execute();

        $results = $statement->fetchAll();

        $statement->closeCursor();

        return $results;
    } // end getRecipeRatings

    function calculateRecipeRating($recipe_id){
        $ratings = getRecipeRatings($recipe_id);
        $sum = 0;
        $x=0;
        if($ratings){
            foreach($ratings as $rating){
                $sum += $rating['rating'];
                $x++;
            }

        }
        return ($x==0?"0":($sum/$x)) . " from " . $x . " ratings";
    } // end calculateRecipeRating

    function updateRecipe($id){
    global $db;

    extract($_REQUEST);

    $query = " UPDATE recipes SET title=:title, description=:description, ingredients=:ingredients, directions=:directions,  modified=NOW() 
                WHERE id=:id and user_id=:user_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $_SESSION['user_id']);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':ingredients', $ingredients);
    $statement->bindValue(':directions', $directions);

    $statement->execute();
    $statement->closeCursor();

    // return the recipe_id or the rowCount if add is unsuccessful
    return $statement->rowCount();

    } //end updateRecipe