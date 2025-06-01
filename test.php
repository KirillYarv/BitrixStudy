<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");


$APPLICATION->IncludeComponent(
	"mein:great_component",
	".default",
	array(
		"X" => "2.8"
	)
);

?>

<script>
	// BX.ajax.runComponentAction("mein:example", "greet", {
	// 	mode: 'class',
	// 	data: {
	// 		"person": 'fdsfds'
	// 	}
	// }).then(function (response) {
	// 	console.log(response);
	// 	/**
	// 	{
	// 		"status": "success",
	// 		"data": {
	// 			"ID": 1,
	// 			"NAME": "test"
	// 		},
	// 		"errors": []
	// 	}
	// 	**/
	// }, function (response) {
	// 	//сюда будут приходить все ответы, у которых status !== 'success'
	// 	console.log(response);
	// 	/**
	// 	{
	// 		"status": "error",
	// 		"errors": [...]
	// 	}
	// 	**/
	// });
</script>
<?
require_once(__DIR__.'/bitrix/crest.php');
// put an example below
echo '<PRE>';
print_r(CRest::call(
    'crm.lead.add',
    [
        'fields' =>[
            'TITLE' => 'Название лида',//Заголовок*[string]
            'NAME' => 'Имя',//Имя[string]
            'LAST_NAME' => 'Фамилия',//Фамилия[string]
        ]
    ])
);
echo '</PRE>';
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>