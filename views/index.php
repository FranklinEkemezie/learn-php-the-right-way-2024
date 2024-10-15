<h2>Home</h2>

<a href="/invoices/create">Create Invoice</a>

<h4>----------- Or ----------------</h4>

<h3>{{ foo }}</h3>

<h3>{{ viewPath }}</h3>

<form action="/upload" method="post" enctype="multipart/form-data">
    <input type="file" name="receipt[]" multiple required>

    <button type="submit">Upload receipt</button>
</form>

<p>
    <button><a href="/signup">Sign Up</a></button>
</p>
