# Function Fishing

## Objective
For this assignment you will be demonstrating your understanding of using functions, conditional statements, HTTP variables, and PHP includes by creating a simple interactive fishing game. 

## Game Play
The player will perform actions by typing in the commands into the form text box. The response for each command will be displayed in the response box. The old responses will remain on the page even as new ones come in. 

Each action may have certain conditions that must be met in order for the task to be performed. When a condition is not correct, the game must inform the player what they should do in order to perform the desired task. After an action has been performed, a status message should be present to the player explain what happened.

### Actions
#### Fishing
When the player goes fishing, they have a *chance* of catching a fish. But the player may only go fishing if:

- The player has at least 1 piece of bait
- The fire has been stopped
 
#### Starting / Stopping a fire
The player can start or stop a fire. The player will start the fire only if:

- The fire has been stopped
- The player has at least 1 piece of wood

The player will stop the fire only if:

- The fire has been started

#### Searching for bait
The player can search for bait, which will increase the player's bait inventory **by one**. The player can go searching for bait if:

- The fire has been stopped

#### Searching for wood
The player can search for wood, which will increase the player's wood inventory **by one**. The player can go searching for wood if:

- The fire has been stopped

#### Eating
The player can eat fish. Each fish will decrease the player's fish inventory **by one**. The player can only eat if:

- The fire has been started
- The player has at least 1 fish

#### Checking inventory
The player can do a check on the inventory status. The inventory status should return a list of how many items the player currently has. 

#### Help
The player can display the instructions on how to play the game.

#### Restarting the Game
The player can clear the current game data by restarting the game. All inventory should be set back to zero.

## Game Data
The game data should be stored and retrieved from session. Each time the Player performs an action, the game data should be retrieved from and updated to the session.

## Commands
The commands received by the player should be sent using the POST method.  

## Requirements
The following requirement must be met in order to complete the assignment successfully: 

### 1. Clone the Repository
Clone this repository from GitHub and use the provided file to complete the assignment. **Warning: The provided file will throw an error if run as is. The error will be fixed after step 3 is successfully completed.**

### 2. Include `functional-fishing.php`
Include `functional-fishing.php` inside `index.php`.

### 3. Create Game Data in Session
1. In `functional-fishing.php`, start a new session
2. In `functional-fishing.php`, create the `createGameData()` function. The function will create a game data array and store it in session and store it in session under the index `functional_fishing`. The game data array should contain the following:
    1. The `response` array
    2. The number of `fish`
    3. The number of `wood`
    4. The number of `bait`
    5. The status of `fire`

### 4. Send commands using the POST Method
In `index.php`, update the form to submit using the `POST` method.

### 5. Check for the `$_POST` array
In `functional-fishing.php`, check for the `$_POST` array for an command from the player. 

1. If a player has entered a command, check If the command matches a existing function (HINT: Use `function_exists()`). 
    1. If so, execute the function passing the results to the `updateResponse()` function.
    2. If not, then add a response to response array in session, using `updateResponse()`, telling the user that the command is not valid.

### 6. Create Game Functions
Each action or command (see above), will require a function. Create the following functions with the necessary requirements:

#### 1. The `fish()` function
The `fish()` function will give the player a chance to catch fish. Each call to the `fish()` function will use **one** piece of bait and randomly determine if a fish has been caught. The requirements for fishing are as follows:

1. The fire must not going
2. The player must have at least 1 piece of bait

#### 2. The `eat()` function
The `eat()` function will allow the player to eat a fish. Each call to the `eat()` function will use **one** fish. The requirements for eating are as follows:

1. The fire must be going
2. The player must have at least 1 fish

#### 3. The `fire()` function
The `fire()` function will allow the player to start or stop the fire and should have the following requirements: 

1. If the `fire()` function is called when the fire is going it should be turned off the fire. 
2. If the `fire()` function is called when the fire is NOT going AND the player has at least 1 piece of wood, the fire should be turned on. 

#### 4. The `bait()` function
The `bait()` function will allow the player to search for bait as long as the fire is not going.

#### 5. The `wood()` function
The `wood()` function will allow the player to search for wood as long as the fire is not going.

#### 6. The `inventory()` function
The `inventory()` function will display the player's current inventory. It should list the amount of fish, bait, wood the player has as well as if the fire is going.

#### 7. The `restart()` function
The `restart()` function will allow the player to clear the current game data and start the game over. 


## Example
A completed version of the assignment can be found at the following:

[http://eisenbm.edumedia.ca/mtm6405/functional-fishing/](http://eisenbm.edumedia.ca/mtm6405/functional-fishing/)

## Rubric
| Criteria | Grade | Pts|
| ---------| ------| ---|
| Create and store game data to session. |  | 1 |
| Allow the player to send commands using the form and retrieve those command using the `POST` method. |  | 1 |
| Create a `fish()` function that meets the all project requirements. |  | 2 |
| Create a `eat()` function that meets the all project requirements. |  | 2 |
| Create a `fire()` function that meets the all project requirements. |  | 2 |
| Create a `bait()` function that meets the all project requirements. |  | 2 |
| Create a `wood()` function that meets the all project requirements. |  | 2 |
| Create a `inventory()` function that meets the all project requirements. |  | 2 |
| Create a `restart()` function that meets the all project requirements. |  | 1 |
| Provide comments explaining the code and your thought process. |  | 5 |

## Submission
1. Create a commit with the message "Completed the Functional Fishing assignment"
2. Push to GitHub
3. Submit the URL to your GitHub Repository to the **Functional Fishing** assignment on BrightSpace


## Plagiarism Honor Code
By making the submission you also agree to the Algonquin College Student Attestation of Academic Integrity below: 

**I hereby declare that the work I submit throughout the duration of this course/program will be my own work.**

**I understand that plagiarism, whether done deliberately or accidentally, is defined as presenting someone else’s work, in whole or in part, as one’s own, and includes the verbal or written submission of another work (for example, ideas, wording, code, graphics, music, and inventions) without crediting that source. This includes all electronic sources (for example, the Internet, television, video, film, and recordings), all print and written sources (for example, books, periodicals, lyrics, government publications, promotional materials, and academic assignments), and all verbal sources (for example, conversations and interviews).**

**I understand that the facilitation of plagiarism, that is, one student sharing his or her work with other students, is also considered an act of plagiarism.**

**I understand that contravening Algonquin College Policy AA 20 - Plagiarism will result in an academic sanction(s) as described in this directive.**