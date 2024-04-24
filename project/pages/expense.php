<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense</title>
    <link rel="stylesheet" href="../css/expense.css">
</head>
<body>
    <div class="form-container">
	    <p class="title">Expenses</p>
	    <form class="form" onsubmit="addExpense(event)">
		    <div class="input-group">
			    <label for="date">Date</label>
			    <input type="date" name="date" id="date" placeholder="">
		    </div>
		    <div class="input-group">
                <label for="category">Category</label>
                <select id="category" name="category" class="category">
                    <option value="food">Food</option>
                    <option value="transportation">Transportation</option>
                    <option value="housing">Housing</option>
                </select> 

            </div>
            <div class="input-group">
			    <label for="item">Item</label>
			    <input type="text" name="item" id="item" placeholder="">
		    </div>
            <div class="input-group">
			    <label for="Amount">Amount</label>
			    <input type="text" name="amount" id="amount" placeholder="">
		    </div>
            <div class="input-group">
			    <label for="details">Details</label>
			    <input type="text" name="details" id="details" placeholder="">
		    </div>
		    <button class="add">Add</button>
	    </form>
    </div>

	<script>
        function addExpense(event) {
            event.preventDefault(); // Prevent form submission
            // Retrieve form data
            const formData = new FormData(event.target);
            const date = formData.get('date');
            const category = formData.get('category');
            const item = formData.get('item');
            const amount = formData.get('amount');
            const details = formData.get('details');

            // Send AJAX request to add expense
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'add_expense.php');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Handle success
                    alert('Expense added successfully');
                    // You can reload the page or perform any other action here
                } else {
                    // Handle error
                    alert('Error adding expense');
                }
            };
            xhr.send(JSON.stringify({ date, category, item, amount, details }));
        }
    </script>
</body>
</html>
