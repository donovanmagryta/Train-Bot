<?php
$mode = urldecode($_GET["mode"]); //read or train or train type.
$name = urldecode($_GET["last name"]);
$priority = urldecode($_GET["priority"]);
$model = urldecode($_GET["model"]);
$num = urldecode($_GET["num"]);
$input = urldecode($_GET["input"]);


if ($mode == 'ask') {
$arrayread = json_decode(file_get_contents('array.json'), true);
$reply = isset($array[$key]) ? $array[$key] : null;
echo $reply;
}

if ($mode == 'get report') {
echo '{"messages": [{"attachment": {"type": "file","payload": {"url": "https://socratic.000webhostapp.com/report.csv"}}}]}';
}



  if ($mode == 'add report') {
  $start = date();
  //$end = date();
  //$diff=date_diff($end,$start);
  $file_open = fopen("report.csv", "a");
  		$no_rows = count(file("report.csv"));
  		if($no_rows > 1)
  		{
  			$no_rows = ($no_rows - 1) + 1;
  		}
  		$form_data = array(
  			'sr_no'	=>	$no_rows,
  			'requested by'	=>	$name,
  			'priority'	=>	$priority,
  			'model'  =>	$model,
  			'submit date'  => $start,
  			'description' => $input,
  			'quantity'  =>  $num

  		);
  		if($no_rows == 0)
  {
      fputcsv($file_open, array_keys($form_data));
  }
  		fputcsv($file_open, $form_data);
  		$name = '';
  		$priority = '';
  		$model = '';
  		$start = '';
  		$input = '';
        $num = '';

  echo '{"messages":[{"text":"entry submitted!"}]}';
  }



if ($mode == "add user question") {
  $question = $input;
}

if ($mode == "add text answer") {
  $answer = '{"messages": [{"text": ".$input."}]}';
}

if ($mode == "add gotoblock answer") {
  $answer = '{"redirect_to_blocks": [".$input.", "Default answer"]}';
}

if ($mode == "quit") {
  $answer = '{"redirect_to_blocks": ["Welcome message", "Default answer"]}';
  echo $answer;
}

if ($mode == "add file answer") {
  $answer = '{"messages": [{"attachment": {"type": "file","payload": {"url": ".$input."}}}]}';
}


if ($mode == "new set") {
  echo '{"set_attributes": {"answer": "not set", "question": "not set"},"messages":[. . .]}';
  $answer = "";
  $question = "";
  $input = "";
  //autoreidrect within chatfuel to admin train block.
}

if ((!empty($answer)) && (!empty($question))) {
  $keys = array($question, $answer);
  $arraywrite = array_fill_keys($keys, $answer);
   file_put_contents("array.json",json_encode($arraywrite), FILE_APPEND);
  //echo ‘{"redirect_to_blocks": ["admin train", "Default answer"]}’;
}

?>
