<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spelling Game</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f4f7;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            flex-direction: column;
        }

        .game-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #0056b3;
        }

        .hint {
            color: #777;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #0056b3;
            color: white;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #004494;
        }

        .timer {
            font-size: 20px;
            color: #d9534f;
            margin: 15px 0;
        }

        .mistakes {
            font-size: 20px;
            color: #d9534f;
        }
    </style>
</head>
<body>
    <div class="game-container">
        <h2>Spelling Game</h2>
        <p id="word"></p>
        <p class="hint" id="hint"></p>
        <input type="text" id="userInput" placeholder="Type the word here" class="form-control" />
        <p class="timer" id="timer">Time: 30 seconds</p>
        <p class="mistakes" id="mistakeCount">Mistakes: 0/3</p>
        <p id="result" class="mt-3"></p>
    </div>

    <script>
        // Predefined words and hints
        const words = [
            { word: 'elephant', hint: 'A large mammal with a trunk.' },
            { word: 'giraffe', hint: 'The tallest land animal.' },
            { word: 'kangaroo', hint: 'A marsupial from Australia.' },
            { word: 'dolphin', hint: 'A highly intelligent marine mammal.' },
            { word: 'octopus', hint: 'A sea creature with eight arms.' },
            { word: 'penguin', hint: 'A flightless bird that swims.' },
            { word: 'pterodactyl', hint: 'A flying reptile from prehistoric times.' },
            { word: 'platypus', hint: 'An egg-laying mammal with a duck bill.' },
            { word: 'rhinoceros', hint: 'A large herbivore with thick skin and horns.' },
            { word: 'hippopotamus', hint: 'A large, mostly herbivorous mammal.' },
            { word: 'caterpillar', hint: 'The larval stage of a butterfly.' },
            { word: 'turtle', hint: 'A reptile with a shell that can retract.' },
            { word: 'chameleon', hint: 'A lizard known for its ability to change color.' },
            { word: 'flamingo', hint: 'A bird with long legs and pink feathers.' },
            { word: 'firefly', hint: 'An insect that produces light.' },
            { word: 'narwhal', hint: 'A whale with a long, spiral tusk.' },
            { word: 'dandelion', hint: 'A common flowering plant with a yellow bloom.' },
            { word: 'koala', hint: 'A marsupial that eats eucalyptus leaves.' },
            { word: 'crocodile', hint: 'A large reptile found in rivers and swamps.' },
            { word: 'salamander', hint: 'An amphibian that can regenerate limbs.' },
            { word: 'zebra', hint: 'A horse-like animal with black and white stripes.' }
        ];

        let currentWord;
        let mistakes = 0;
        const maxMistakes = 3;
        let timeLeft = 30;
        let timerId;

        function getRandomWord() {
            const randomIndex = Math.floor(Math.random() * words.length);
            return words[randomIndex];
        }

        function displayWord() {
            currentWord = getRandomWord();
            document.getElementById('word').textContent = currentWord.word;
            document.getElementById('hint').textContent = currentWord.hint;
            document.getElementById('userInput').value = '';
            document.getElementById('result').textContent = '';
            document.getElementById('mistakeCount').textContent = `Mistakes: ${mistakes}/${maxMistakes}`;
            startTimer();
        }

        function startTimer() {
            clearInterval(timerId);
            timeLeft = 30;
            document.getElementById('timer').textContent = `Time: ${timeLeft} seconds`;

            timerId = setInterval(() => {
                timeLeft--;
                document.getElementById('timer').textContent = `Time: ${timeLeft} seconds`;
                if (timeLeft <= 0) {
                    clearInterval(timerId);
                    document.getElementById('result').textContent = 'Time is up! Game Over!';
                    document.getElementById('userInput').disabled = true;
                }
            }, 1000);
        }

        function checkAnswer() {
            const userInput = document.getElementById('userInput').value.toLowerCase();
            if (userInput === currentWord.word) {
                document.getElementById('result').textContent = 'Correct!';
                displayWord();
            } else if (userInput.length > currentWord.word.length) {
                document.getElementById('result').textContent = 'Incorrect, too long!';
            } else if (userInput.length > 0) {
                mistakes++;
                document.getElementById('result').textContent = 'Incorrect, try again!';
                document.getElementById('mistakeCount').textContent = `Mistakes: ${mistakes}/${maxMistakes}`;
                if (mistakes >= maxMistakes) {
                    clearInterval(timerId);
                    document.getElementById('result').textContent = 'Maximum mistakes reached! Game Over!';
                    document.getElementById('userInput').disabled = true;
                }
            }
        }

        // Display a random word on initial load
        displayWord();

        // Add event listener for real-time checking
        document.getElementById('userInput').addEventListener('input', checkAnswer);
    </script>
</body>
</html>
