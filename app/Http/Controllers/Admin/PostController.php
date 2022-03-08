<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(12);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();
        $request->validate($this->getValidationRules());

        $new_post = new Post();
        $new_post->fill($form_data);

        $new_post->slug = Post::generateSlug($new_post->title);

        if (isset($form_data['image'])) {
            $img_src = Storage::put('post_covers', $form_data['image']);

            $new_post->cover = $img_src;
        }
        $new_post->save();

        // Se l' array tags e' non null, ed un array e' non null anche se e' vuoto,
        // Sincronizza la tabella pivot con gli id dentro l'array tags, se vengono cancellati gli id dei tag allora 
        // la relazione tra tag e post viene cancellata 
        if(isset($form_data['tags'])) {
            $new_post->tags()->sync($form_data['tags']);
        }
        // !TODO controlla se qui ci va l' else perche' se non selezioni niente nel form viene inviata un chiave tags che e' null 

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {    
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {   
        $tags = Tag::all();
        $categories = Category::all();
        // dd($post->category);
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $updated_post_data = $request->all();
        
        $request->validate($this->getValidationRules());

        if($updated_post_data['title'] != $post->title) {
            $post->slug = Post::generateSlug($updated_post_data['title']);
        }

        // Se viene messa una nuova immagine 
        if($updated_post_data['image']) {
            // Cancello il file vecchio
            if($post->cover) {
                Storage::delete($post->cover);
            }

            // Faccio l'upload il nuovo file
            $img_path = Storage::put('post_covers', $updated_post_data['image']);

            // Salvo nella colonna cover il path al nuovo file
            $updated_post_data['cover'] = $img_path;
            // !Ricorda Aggiungi il fillable nel model che qui fai un mass assignment poi non funziona.
        }

        $post->update($updated_post_data);

        if(isset($updated_post_data['tags'])) {
            $post->tags()->sync($updated_post_data['tags']);
        } else {
            $post->tags()->sync([]);
        }
        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   
        $post->tags()->sync([]);
        if ($post->cover) {
            Storage::delete($post->cover);
        }
        $post->delete();
        
        return redirect()->route('admin.posts.index');
    }

    public function getValidationRules() {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:60000',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id|nullable',
            'image' => 'image|max:512|nullable'
        ];
    }
}
