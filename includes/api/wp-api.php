<?php
add_action('rest_api_init', 'delibera_register_api_fields');

function delibera_register_api_fields()
{
	register_rest_field('pauta', 'situacao', 
			array(
				'get_callback' => 'slug_get_situacao',
				'update_callback' => null,
				'schema' => null
			));
	register_rest_field('pauta', 'user_name',
			array(
				'get_callback' => 'delibera_api_user_name',
				'update_callback' => null,
				'schema' => null
			));
	register_rest_field('pauta', 'avatar',
			array(
				'get_callback' => 'delibera_api_avatar',
				'update_callback' => null,
				'schema' => null
			));
}

/**
 * Get the value of the "situação" field
 *
 * @param array $object
 *        	Details of current .
 * @param string $field_name
 *        	Name of field.
 * @param WP_REST_Request $request
 *        	Current request
 *        	
 * @return mixed
 */
function slug_get_situacao($object, $field_name, $request)
{
	return delibera_get_situacao( $object[ 'id' ] )->slug;
}

/**
 * Get the value of the "user_name" field
 *
 * @param array $object
 *        	Details of current .
 * @param string $field_name
 *        	Name of field.
 * @param WP_REST_Request $request
 *        	Current request
 *
 * @return mixed
 */
function delibera_api_user_name($object, $field_name, $request)
{
	$pauta = get_post($object['id']);
	$user = get_author_name($pauta->post_author);
	return $user;
}

/**
 * Get the value of the "situação" field
 *
 * @param array $object
 *        	Details of current .
 * @param string $field_name
 *        	Name of field.
 * @param WP_REST_Request $request
 *        	Current request
 *
 * @return mixed
 */
function delibera_api_avatar($object, $field_name, $request)
{
	$pauta = get_post($object['id']);
	$avatar = get_avatar_url($pauta->post_author);
	return $avatar;
}
