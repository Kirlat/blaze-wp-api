<?php
namespace Blaze\API\Routes;


class List_Controller extends \WP_REST_Controller
{
    /**
     * Register the routes for the objects of the controller.
     */
    public function register_routes() {
        $version = '1';
        $namespace = 'blaze/v' . $version;
        $base = 'list';
        register_rest_route( $namespace, '/' . $base, array(
            array(
                'methods'         => \WP_REST_Server::READABLE,
                'callback'        => array( $this, 'get_items' ),
                'args'            => array(

                ),
            )
        ) );
    }

    /**
     * Get a collection of items
     *
     * @param \WP_REST_Request $request Full data about the request.
     * @return \WP_Error|\WP_REST_Response
     */
    public function get_items( $request ) {
        // Query parameters
        $query_params = array(
            'post_type' => 'post',
            'posts_per_page' => -1
        );

        //get parameters from request
        $params = $request->get_params();

        if (isset($params['category_name']) || array_key_exists('category_name', $params)) {
            $categories = implode(',', $params['category_name']);
            $query_params['category_name'] = $categories;
        }

        $query = new \WP_Query( $query_params );
        $items = array();
        // Check that we have query results.
        if ( $query->have_posts() ) {
            // Start looping over the query results.
            while ( $query->have_posts() ) {
                $query->the_post();
                $post_data = array (
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'url' => get_permalink()
                );
                array_push($items, $post_data);
            }
        }
        // Restore original post data.
        wp_reset_postdata();

        return new \WP_REST_Response( $items, 200 );
    }
}