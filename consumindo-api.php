<?php
function funcaoApi()
{
	$request = wp_remote_post('https://informeSuaApi.com.br/api', [
		'headers' => [
			'Content-Type' => 'application/json',
		],
		'body' => wp_json_encode([
			'query' => '
						{
							getAccrediteds{
								id
								firstName
								lastName    
								accredited{
									phone,
									address{
										city
										street												
										number
										state
										neighborhood
									},
									
									category{
										title
									},
									
									subCategories{
										title
									}
								}    
							}
						}
				'
		])
	]);
	$decoded_response = json_decode($request['body'], true);
}


function consumindoApi()
{
	$request = wp_remote_post('https://informeSuaApi.com.br/api', [
		'headers' => [
			'Content-Type' => 'application/json',
		],
		'body' => wp_json_encode([
			'query' => '
						{
							getAccrediteds{
								id
								firstName
								lastName    
								accredited{
									phone,
									address{
										city
										street												
										number
										state
										neighborhood
									},
									
									category{
										title
									},
									
									subCategories{
										title
									}
								}    
							}
						}
				'
		])
	]);
	$decoded_response = json_decode($request['body'], true);


	foreach ($decoded_response['data']['getAccrediteds'] as $credenciados) {
		$accredited = $credenciados['accredited'];
		$category = $accredited['category']['title'];
		$address = $accredited['address'];

		foreach ($accredited['subCategories'] as $subCategories) {
			$subCategory = $subCategories['title'];
		}

		echo " 
			<tr>
				<td>$category</td>
				<td>$subCategory</td>
				<td>$credenciados[firstName] $credenciados[lastName]</td>
				<td>$address[street] , $address[number], $address[neighborhood]</td>
				<td>$address[city]/$address[state]</td>
				<td class='listTel'>$accredited[phone]</td>
			</tr>";
	}
}
