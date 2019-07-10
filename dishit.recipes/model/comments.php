<?php
function getComments($id) {
    global $db;

    $query = "Select c.comment, u.username, c.modified, c.created from comments c 
                inner join users u on u.id = c.user_id
                inner join recipes r on r.id = c.recipe_id 
                where r.id=:id
                order by c.created";

    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    //Parameters processed here
    $statement->execute();

    $results = $statement->fetchAll();

    $statement->closeCursor();

    return $results;
}// end getComments

function insertComment($recipe_id, $comment){
    global $db;

    extract($_REQUEST);

    $query = "INSERT INTO comments(user_id,recipe_id,comment,created,modified) 
                                values (
                                    :user_id,
                                    :recipe_id,
                                    :comment,
                                    NOW(),
                                    NOW())"; // approve by default for testing
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $_SESSION['user_id']);
    $statement->bindValue(':recipe_id', $recipe_id);
    $statement->bindValue(':comment', $comment);

    $statement->execute();
    $statement->closeCursor();

    if($statement->rowCount()==1){
        return $recipe_id;
    } else {
        return $statement->rowCount();
    }
} // end insertComments


function updateComment($recipe_id, $comment){
    global $db;

    extract($_REQUEST);

    $query = "UPDATE COMMENTS SET comment=:comment, modified=NOW()
                WHERE recipe_id=:recipe_id and user_id=:user_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $_SESSION['user_id']);
    $statement->bindValue(':recipe_id', $recipe_id);
    $statement->bindValue(':comment', $comment);

    $statement->execute();
    $statement->closeCursor();

    // return the recipe_id or the rowCount if add is unsuccessful
    return $statement->rowCount();

} //end updateComment

function commentSaveNew($recipe_id, $comment){
    // if empty then insert new
        updateRating($recipe_id, $comment); // doesn't seem to work

        insertRating($recipe_id, $comment);

} // end rateRecipe