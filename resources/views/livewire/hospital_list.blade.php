<style>
    table{
        text-align: left;
    }

</style>

<table border="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Hospital Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Bond</th>
            <th>Since</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Connect to the database (replace with your database credentials)
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "hospital";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to fetch data from the database
        $sql = "SELECT * FROM hospitals";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data in the table rows
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["hospital_name"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["bond_of"] . "</td>";
                echo "<td>" . $row["since"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "No records found";
        }

        // Close the database connection
        $conn->close();
        ?>
    </tbody>
<table>
    