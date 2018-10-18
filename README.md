# Bug in wp_update_post()

This plugin demonstrates bug in wp_update_post(). 

Activate it on clean WP. Plugin creates two tags with slugs `wp_update_post_tag_1` and `wp_update_post_tag_2` and the same name `wp_update_post_tag`.

Go to `/wpup-test/` page of your site. You will see output like that

wp_get_post_tags() Before wp_update_post()

    array (size=1)
      0 => 
            object(WP_Term)[312]
              public 'term_id' => int 39
              public 'name' => string 'wp_update_post_tag' (length=18)
              public 'slug' => string 'wp_update_post_tag_2' (length=20)
              public 'term_group' => int 0
              public 'term_taxonomy_id' => int 39
              public 'taxonomy' => string 'post_tag' (length=8)
              public 'description' => string '' (length=0)
              public 'parent' => int 0
              public 'count' => int 1
              public 'filter' => string 'raw' (length=3)
        
        wp_get_post_tags() After wp_update_post()
        
        array (size=1)
          0 => 
            object(WP_Term)[314]
              public 'term_id' => int 38
              public 'name' => string 'wp_update_post_tag' (length=18)
              public 'slug' => string 'wp_update_post_tag_1' (length=20)
              public 'term_group' => int 0
              public 'term_taxonomy_id' => int 38
              public 'taxonomy' => string 'post_tag' (length=8)
              public 'description' => string '' (length=0)
              public 'parent' => int 0
              public 'count' => int 1
              public 'filter' => string 'raw' (length=3)

tag attached to the post has changed.

And that's nice.