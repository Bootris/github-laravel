<h2>
    {{$job->title}}
</h2>

<p>
Congrats! your mail is live on website
</p>

<p>
    <a href="{{ url('/jobs/' . $job->id) }}">View your Job Listing</a>
</p>