<?php

function total_articles() {
	return Post::where(Base::table('posts.status'), '=', 'published')->count();
}

function article_date_custom() {
	if($created = Registry::prop('article', 'created')) {
		return Date::format($created, 'jS F Y');
	}
}

function category_count_for_id($id) {
	return Query::table(Base::table('posts'))
		->where('category', '=', $id)
		->where('status', '=', 'published')->count();
}

function sorted_categories() {
	$items = Category::dropdown();

	natcasesort($items);

	return $items;
}

function footer_year() {
	  $fromYear = 2015;
	  $thisYear = (int)date('Y'); 
	  return '&copy; ' . $fromYear . (($fromYear != $thisYear) ? ' - ' . $thisYear : '');
}

function article_previous_link() {
	$page = Registry::get('posts_page');
	$query = Post::where('created', '<', Registry::prop('article', 'created'))
				->where('status', '!=', 'draft');

	if($query->count()) {
		$article = $query->sort('created', 'desc')->fetch();
		$page = Registry::get('posts_page');

		return '<a href="' . base_url($page->slug . '/' . $article->slug) . '">' . '&laquo; ' . $article->title . '</a>';
	}
}

function article_next_link() {
	$page = Registry::get('posts_page');
	$query = Post::where('created', '>', Registry::prop('article', 'created'))
				->where('status', '!=', 'draft');

	if($query->count()) {
		$article = $query->sort('created', 'asc')->fetch();
		$page = Registry::get('posts_page');

		return '<a href="' . base_url($page->slug . '/' . $article->slug) . '">' . $article->title . ' &raquo;</a>';
	}
}

/**
 * TAGS
 */

/**
* Returns an array of unique tags that exist on pages
*
* @return array
*/
function get_page_tags() {
  $tag_ext = Extend::where('key', '=', 'page_tags')->where('data_type', '=', 'page')->get();
  $tag_id = $tag_ext[0]->id;

  $prefix = Config::db('prefix', '');

  $tags = array();
  $index = 0;
  foreach(Query::table($prefix.'page_meta')
	->left_join('pages', 'pages.id', '=', 'page_meta.page')
	->where('pages.status', '=', 'published')
	->where('extend', '=', $tag_id)
	->get() as $meta) {
	$page_meta = json_decode($meta->data);
	foreach(explode(", ", $page_meta->text) as $tag_text) {
	  $tags[$index] = $tag_text;
	  $index += 1;
	}
  }

  return array_unique($tags);
}

/**
 * Returns an array of ids for pages that have the specified tag
 *
 * @param string
 * @return array
 */
function get_pages_with_tag($tag='') {
  $tag_ext = Extend::where('key', '=', 'page_tags')->get();
  $tag_id = $tag_ext[0]->id;

  $prefix = Config::db('prefix', '');

  $pages = array();
  foreach(Query::table($prefix.'page_meta')
	->where('extend', '=', $tag_id)
	->where('data', 'LIKE', '%'.$tag.'%')
	->get() as $meta) {

	$pages[] = $meta->page;
  }

  return array_unique($pages);
}

/**
* Returns an array of unique tags that exist on posts
*
* @return array
*/
function get_post_tags() {
  $tag_ext = Extend::where('key', '=', 'post_tags')->where('type', '=', 'post')->get();
  $tag_id = $tag_ext[0]->id;

  $prefix = Config::db('prefix', '');

  $tags = array();
  $index = 0;
  foreach(Query::table($prefix.'post_meta')
	->left_join($prefix.'posts', $prefix.'posts.id', '=', $prefix.'post_meta.post')
	->where($prefix.'posts.status', '=', 'published')
	->where('extend', '=', $tag_id)
	->get() as $meta) {
		$post_meta = json_decode($meta->data);

		$split_tags = explode(' ', $post_meta->text);

		foreach ($split_tags as $tag) {
			if ($tag != '')
				$tags[] = $tag;
		}
	}

  	$tags = array_unique($tags);

  	natcasesort($tags);

  	return $tags;
}

/**
 * Returns an array of ids for posts that have the specified tag
 *
 * @param string
 * @return array
 */
function get_posts_with_tag($tag) {
  $tag_ext = Extend::where('key', '=', 'post_tags')->get();
  $tag_id = $tag_ext[0]->id;

  $prefix = Config::db('prefix', '');

  $posts = array();
  foreach(Query::table($prefix.'post_meta')
	->where('extend', '=', $tag_id)
	->where('data', 'LIKE', '%'.$tag.'%')
	->get() as $meta) {

	$posts[] = $meta->post;
  }

  return array_unique($posts);
}

/**
 * Returns true if there is at least one tagged post
 * This replaces the Anchor has_posts() method
 *
 * @return bool
 */
function has_tagged_posts() {
  if(isset($_GET) && array_key_exists('tag',$_GET) && $tag = $_GET['tag']) {
	if($tagged_posts = get_posts_with_tag($tag)) {
	  $count = Post::
	  where_in('id', $tagged_posts)
	  ->where('status', '=', 'published')
	  ->count();
	} else {
	  $count = 0;
	}

	Registry::set('total_tagged_posts', $count);
  } else {
	Registry::set('total_tagged_posts', 0);
	return has_posts();
  }

  return Registry::get('total_tagged_posts', 0) > 0;
}

/**
 * Returns true while there are still tagged posts in the array.
 * This replaces the Anchor posts() method
 *
 * @return bool
 */
function tagged_posts() {
  if(isset($_GET) && array_key_exists('tag',$_GET) && $tag = $_GET['tag']) {
	if(! $posts = Registry::get('tagged_posts')) {
	  $tagged_posts = get_posts_with_tag($tag);
	  $posts = Post::
	  where_in('id', $tagged_posts)
	  ->where('status', '=', 'published')
	  ->sort('created', 'desc')
	  ->get();

	  Registry::set('tagged_posts', $posts = new Items($posts));
	}

	if($posts instanceof Items) {
	  if($result = $posts->valid()) {
		// register single post
		Registry::set('article', $posts->current());

		// move to next
		$posts->next();
	  }
	  // back to the start
	  else $posts->rewind();

	  return $result;
	}
  } else {
	return posts();
  }

  return false;
}

function format_post_tags($tags) {
	$tags = explode(' ', $tags);

	$formatted = '';

	foreach ($tags as $tag) {
		$formatted .= '<code class="article__tag"><a href="/posts?tag='.$tag.'">'.$tag.'</a></code> ';
	}

	return $formatted;
}