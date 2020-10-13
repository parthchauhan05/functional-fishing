<?php


/**********************************************
 * STARTER CODE
 **********************************************/

/**
 * clearSession
 * This function will clear the session.
 */
function clearSession()
{
  session_unset();
  header("Location: " . $_SERVER['PHP_SELF']);
}

/**
 * Invokes the clearSession() function.
 * This should be used if your session becomes wonky
 */
if (isset($_GET['clear'])) {
  clearSession();
}
session_start();
/**
 * getResponse
 * Gets the response history array from the session and converts to a string
 * 
 * This function should be used to get the full response array as a string
 * 
 * @return string
 */
function getResponse()
{
  return implode('<br><br>', $_SESSION['functional_fishing']['response']);
}

/**
 * updateResponse
 * Adds a new response to the response array found in session
 * Returns the full response array as a string
 * 
 * This function should be used each time an action returns a response
 * 
 * @param [string] $response
 * @return string
 */
function updateResponse($response)
{
  if (!isset($_SESSION['functional_fishing'])) {
    createGameData();
  }
  array_push($_SESSION['functional_fishing']['response'], $response);

  return getResponse();
}

/**
 * help
 * Returns a formatted string of game instructions
 * 
 * @return string
 */
function help()
{
  return 'Welcome to Functional Fishing, the text based fishing game. Use the following commands to play the game: <span class="red">eat</span>, <span class="red">fish</span>, <span class="red">fire</span>, <span class="red">wood</span>, <span class="red">bait</span>. To restart the game use the <span class="red">restart</span> command For these instruction again use the <span class="red">help</span> command';
}

/**********************************************
 * YOUR CODE BELOW
 **********************************************/
/**
 * createGameData
 * 
 */

function createGameData() {
  $_SESSION['functional_fishing'] = array(
    "fire" => false,
    "fish" => 0,
    "bait" => 0,
    "wood" => 0,
    "response" => []
  );
}
// GEt Command and execute.
if (isset($_POST['command'])) {
  // Split if more than one word is given.
  $command = explode(' ', $_POST['command']);
  // Check if the word is valid command or not
  if (function_exists($command[0])) {
    // Execute command
    $response = $command[0]();
    updateResponse($response);
  } else {
      updateResponse("{$_POST['command']} is not a valid command.");
  }
}

/**
 * fire
 *
 */
function fire() {
  // Check Fire is going.
  if ($_SESSION['functional_fishing']['fire']) {
    //If going, turn it off.
    $_SESSION['functional_fishing']['fire'] = false;
    return "Fire has been put out.";
  } else {
    // Fire is not going, decrease wood, set fire on.
    if ($_SESSION['functional_fishing']['wood'] > 0) {
        $_SESSION['functional_fishing']['wood']--;
        $_SESSION['functional_fishing']['fire'] = true;
        return "Fire has been started.";
    } else {
        return "You do not have enough wood.";
    }
  }
}

/**
 * bait
 * 
 */
function bait() {
  // Check fire.
  if ($_SESSION['functional_fishing']['fire']) {
    // If fire is on, turn it off.
    return "You need to put out fire.";
  } else {
    //If fire is out, increase bait.
    $_SESSION['functional_fishing']['bait'] ++;
    return "You found some bait.";
  }
}

/**
 * wood
 * 
 */
function wood() {
  //Check fire.
  if ($_SESSION['functional_fishing']['fire']) {
    // If fire is going, turn it off.
    return "You need to put out fire.";
  } else {
    // If fire is out, increase wood.
    $_SESSION['functional_fishing']['wood'] ++;
    return "You found some wood.";
  }
}

/**
 * fish
 * 
 */
function fish() {
  // Check fire.
  if ($_SESSION['functional_fishing']['fire']) {
    //If fire is going, turn it off.
    return "You need to put out fire.";
  } else {
    // If fire is out, Check for bait.
    if ($_SESSION['functional_fishing']['bait'] > 0) {
      // If you Have more than 1 bait, decrease bait, you may find fish. 
        $_SESSION['functional_fishing']['bait'] --;
        // check randomly if you got fish or not.
        if(rand(0,1)){
          // Fish found, increase fish
          $_SESSION['functional_fishing']['fish'] ++;
          return "You found some fish.";
        } else{
          // fish not found.
          return "You do not find a fish.";
        }
        
    } else {
        return "You do not have enough bait.";
    }
  }
}

/**
 * eat
 * 
 */
function eat() {
  //check fire.
  if ($_SESSION['functional_fishing']['fire']) {
    // Fire is on, Check Fish
    if($_SESSION['functional_fishing']['fish']>0){
      // Decrease Fish to eat.
      $_SESSION['functional_fishing']['fish'] --;
      return "You ate fish.";
    } else {
      // Zero Fish in inventory
      return "You do not have any fish.";
    }
  } else {
    //Fire off.
    return "Fire must be going";
  } 
}

/**
 * inventory
 * 
 */
function inventory() {
  $response = '' ;
   
  foreach($_SESSION['functional_fishing'] as $item => $value){
    if ($item === 'fire') {
      if ($value) {
        $response .= "The fire is on.<br>";
      } else {
        $response .= "The fire is out.<br>";
      }
    } else if (!is_array($value)) {
      $response .= "{$item} -> ${value} <br>";
    }
  }

  return $response;
}

/**
 * restart
 * 
 */
function restart() {
  // Clear Session, then start the game again.
  clearSession();
  updateResponse(help());
}

?>