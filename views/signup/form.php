<div id="signup-form-container">
    <h2>Signup Form</h2>
    <form action="/signup" method="post" id="signup-form">
        <p>
            <label for="">Fullname: </label>
            <input type="text" name="{{ fullname_name }}" id="" placeholder="Enter your name" required />
        </p>
        <p>
            <label for="">Email: </label>
            <input type="email" name="{{ email_name }}" id="" placeholder="Enter your email" required/>
        </p>
        <p>
            <label for="">Amount: </label>
            <input type="number" name="{{ invoice_amount_name }}" id="" placeholder="Amount" required />
        </p>

        <!-- Submit button -->
         <button type="submit">Signup</button>
    </form>
</div>