<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Services\Markdowner;
use Carbon\Carbon;

class Post extends Model
{
    protected $dates = ['published_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'content', 'image_path', 'published_at', 
    ];

    /**
     * Set the post title
     *
     * @param string $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

    if (! $this->exists) {
        $this->attributes['slug'] = str_slug($value);
        }
    }

    /**
     * Many to Many relation
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'post_tags');
    }

    /**
     * One to Many relation
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * One to Many relation
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Format the image input
     */
    public static function formatImage($image_input, $post)
    {
        $extension = $image_input->getClientOriginalExtension(); // Get image extension
        $now = new \DateTime(); // Get date and time
        $date = $now->getTimestamp(); // Convert date and time in timestamp
        $fileName = $date . '.' . $extension; // Give name to image
        $destinationPath = 'pictures'; // Define destination path
        $img = $image_input->move($destinationPath, $fileName); // Upload image to destination path
        $new_path = $destinationPath . '/' . $fileName; // Write image path in DB
        $post->image_path = $new_path;
        
        // Resize image
        $filename = $new_path; // Get image

        // Resize image to format 900px/300px
        $size = getimagesize($filename); // Get image size

        $ratio = $size[0]/$size[1]; // Get ratio width/height

        if ($ratio > 3) { // If ratio is greater than optimal (900px/300px)
            $new_width = $size[0]/($size[1]/300);
            $new_height = 300;
            $shift_x = (($new_width - 900)*($size[0]/$new_width))/2;
            $shift_y = 0;
        } elseif ($ratio < 3) { // If ratio is less than optimal (900px/300px)
            $new_width = 900;
            $new_height = $size[1]/($size[0]/900);
            $shift_x = 0;
            $shift_y = (($new_height - 300)*($size[1]/$new_height))/2; //should be equal to 330 or 220
        } else { // If ratio is already optimal (900px/300px = 3)
            $new_width = 900;
            $new_height = 300;
            $shift_x = 0; // No need to crop horizontally
            $shift_y = 0; // No need to crop vertically
        }

        $src = imagecreatefromstring(file_get_contents($filename));

        $dst = imagecreatetruecolor(900,300);
        imagecopyresampled($dst, $src, 0, 0, $shift_x, $shift_y, $new_width, $new_height, $size[0], $size[1]);
        imagedestroy($src); // Free up memory
        imagejpeg($dst, $filename, 100); // adjust format as needed
        imagedestroy($dst);
    }
}