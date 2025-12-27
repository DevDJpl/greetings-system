<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

function checkBadWords($text){
	$badWords = [
		'shit',
		'fuck',
		'fucker',
		'fucking',
		'fucks',
		'fuckers',
		'nigger',
		'niggers',
		'motherfucker',
		'asshole',
		'Assface',
		'asswipe',
		'assholes',
		'pussy',
		'faggot',
		'faggots',
		'fags',
		'fag',
		'fuckin',
		'nigga',
		'cockhead',
		'cock-head',
		'CockSucker',
		'cock-sucker',
		'cunt',
		'cunts',
		'cock',
		'cocks',
		'shitty',
		'shittiest',
		'shits',
		'ass',
		'bitch',
		"bitch's",
		'bitches',
		'bitchs',
		'cock gobbler',
		'lesbionic',
		'dickhead',
		'dick head',
		'dickheads',
		'dick heads',
		'dickhole',
		'dick hole',
		'gurgle monster',
		'cum dumpster',
		'Carpet Muncher',
		'fatass',
		'fat-ass',
		'slut',
		'Blow Job',
		'Clit',
		'dildo',
		'jackoff',
		'jerk-off',
		'blow jobs',
		'anus',
		'bastard',
		'bastards',
		'butthole',
		'buttwipe',
		'crap',
		'God Damn',
		'God Damned',
		'God Damnit',
		'slut',
		'sluts',
		'Slutty',
		'jizz',
		'testicle',
		'butt-pirate',
		'nutsack',
		'nuttsack',
		'ahole',
		'ash0le',
		'ash0les',
		'asholes',
		'assh0le',
		'assh0lez',
		'assholz',
		'azzhole',
		'bassterds',
		'bastardz',
		'basterds',
		'basterdz',
		'Biatch',
		'c0ck',
		'c0cks',
		'c0k',
		'cawk',
		'cawks',
		'cuntz',
		'dild0',
		'dild0s',
		'dildos',
		'dilld0',
		'dilld0s',
		'f u c k',
		'f u c k e r',
		'f u c k i n g',
		'fag1t',
		'faget',
		'fagg1t',
		'faggit',
		'fagit',
		'fagz',
		'faig',
		'faigs',
		'Fudge Packer',
		'fuk',
		'Fukah',
		'Fuken',
		'fuker',
		'Fukin',
		'Fukk',
		'Fukker',
		'Fukkin',
		'jizm',
		'slutz',
		'assopedia',
	];
	
	$smallText = strtolower($text);
	foreach($badWords as $badWord){
		$startIndex = strpos($smallText, strtolower($badWord));
		if($startIndex !== false){
			$lengthOfStars = strlen($badWord) - 2;
			$lastIndex = $startIndex + strlen($badWord) - 1;
			$text = str_ireplace($badWord, $text[$startIndex].str_repeat("*", $lengthOfStars).$text[$lastIndex], $text);
		}
	}
	
	return $text;
}

if($_SERVER['REQUEST_METHOD']=="POST"){
	$name = trim($_POST['name']);
	$message = checkBadWords(trim($_POST['message']));
	
	$data = [
		[
			"name"=> $name,
			"message"=> $message,
		],
	];
	if(!file_exists("data/greetings.json")){
		file_put_contents("data/greetings.json", json_encode($data));
	}else{
		$current_data = json_decode(file_get_contents('data/greetings.json'));
		if(count($current_data)==10){
			file_put_contents("data/greetings.json", json_encode($data));
		}else{
			$new_data = $current_data;
			$new_data[] = $data[0];
			file_put_contents("data/greetings.json", json_encode($new_data));
		}
	}
}

$names = [
	'Johnathon',
	'Anthony',
	'Erasmo',
	'Raleigh',
	'Nancie',
	'Tama',
	'Camellia',
	'Augustine',
	'Christeen',
	'Luz',
	'Diego',
	'Lyndia',
	'Thomas',
	'Georgianna',
	'Leigha',
	'Alejandro',
	'Marquis',
	'Joan',
	'Stephania',
	'Elroy',
	'Zonia',
	'Buffy',
	'Sharie',
	'Blythe',
	'Gaylene',
	'Elida',
	'Randy',
	'Margarete',
	'Margarett',
	'Dion',
	'Tomi',
	'Arden',
	'Clora',
	'Laine',
	'Becki',
	'Margherita',
	'Bong',
	'Jeanice',
	'Qiana',
	'Lawanda',
	'Rebecka',
	'Maribel',
	'Tami',
	'Yuri',
	'Michele',
	'Rubi',
	'Larisa',
	'Lloyd',
	'Tyisha',
	'Samatha',
];

function loripsum(
    int $paragraphs = 1,
    string $length = 'medium',
    bool $plaintext = false
) {
    $sentences = [
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
        "Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
        "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
        "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
        "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
        "Curabitur pretium tincidunt lacus. Nulla gravida orci a odio.",
        "Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris.",
        "Integer in mauris eu nibh euismod gravida.",
        "Morbi auctor lorem non justo semper feugiat.",
        "Suspendisse potenti. In hac habitasse platea dictumst."
    ];

    switch ($length) {
        case 'short':
            $sentencesPerParagraph = [1,2];
            break;
        case 'long':
            $sentencesPerParagraph = [6,10];
            break;
        default:
            $sentencesPerParagraph = [3,5];
    }

    $output = [];
    for ($i = 0; $i < $paragraphs; $i++) {
        $count = rand($sentencesPerParagraph[0], $sentencesPerParagraph[1]);
        $para = [];
        for ($j = 0; $j < $count; $j++) {
            $para[] = $sentences[array_rand($sentences)];
        }

        $paragraph = implode(" ", $para);
        if ($plaintext) {
            $output[] = $paragraph;
        } else {
            $output[] = "<p>$paragraph</p>";
        }
    }

    return implode($plaintext ? "\n\n" : "\n", $output);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Title -->
	<title>Greetings System</title>
	
	<!-- Meta -->
	<meta name="description" content="Greetings System by DevDJ" />
	<meta name="author" content="DevDJ" />
	<meta name="copyrights" content="DevDJ" />
	<meta name="revised" content="01.01.2022" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="googlebot" content="all" />
	<meta name="robots" content="noindex, nofollow" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="UTF-8" />
	
	<!-- Style CSS -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div id="content">
		<div class="greetings-form-wrapper">
			<div class="greetings-form-inner">
				<form class="greetings-form" method="POST" action="">
					<div class="form-header">
						<div class="logo-image"></div>
						<h3>Greetings Form</h3>
					</div>
					<div class="form-content">
						<div class="form-group">
							<input class="form-input" type="text" id="name" name="name" value="<?php echo $names[rand(0, count($names) -1)]; ?>" placeholder="Your Name" readonly required>
						</div>
						<div class="form-group">
							<textarea type="text" id="message" name="message" placeholder="Your Greetings Message" readonly required><?php echo trim(htmlspecialchars_decode(loripsum(1, "short", true))); ?></textarea>
						</div>
						<div class="form-info">
							<span>* Required</span>
						</div>
					</div>
					<div class="form-actions">
						<button class="btn btn-primary" type="submit">
							<p class="btn-text">Send Greetings</p>
						</button>
					</div>
				</form>
				<div class="footer">
					<p class="copyrights">&copy <script>document.write(new Date().getFullYear())</script> <a alt="Greetings System" name="Greetings System" href="">Greetings System</a> - All Rights Reserved | Stylized on <a alt="Radio 538" name="Radio 538" href="//www.538.nl">Radio 538</a><br>Made with <span class="heart">♥</span> by <a class="author" alt="DevDJ" name="DevDJ" target="_blank" href="//devdj.pl">DevDJ</a></p>
				</div>
			</div>
		</div>
		<div class="greetings-display-wrapper">
			<div class="greetings-display-inner">
				<div class="greetings-display-background">
					<img class="display-image" src="images/background.jpg">
					<div class="overlay">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 121 240">
							<g xmlns="http://www.w3.org/2000/svg" fill="none" fill-rule="evenodd">
								<g><g><path class="overlay-shape" d="M120 0v100.572C118.413 65.793 112.58 32.105 103 0v240H0V0h120zm0 139.428V240h-17c9.579-32.105 15.412-65.793 17-100.572zM0 0h103v240H0V0z" transform="translate(-3946.000000, -1981.000000) translate(3946.904382, 1981.000000) translate(60.000374, 120.000000) scale(-1, 1) translate(-60.000374, -120.000000)"></path>
								<path d="M0.096 0H120.096V240H0.096z" transform="translate(-3946.000000, -1981.000000) translate(3946.904382, 1981.000000)"></path></g></g>
							</g>
						</svg>
					</div>
				</div>
				<div class="greetings-display-content">
					<?php
					if(file_exists("data/greetings.json")){
						$greetings = json_decode(file_get_contents('data/greetings.json'));
						if(!empty($greetings)){
							echo("<marquee>");
							foreach($greetings as $greeting){
								echo("<span><strong>".$greeting->name."</strong><p>".$greeting->message."</p></span>");
							}
							echo("</marquee>");
						}
					}
					?>
					
				</div>
			</div>
		</div>
	</div>
</body>
</html>
