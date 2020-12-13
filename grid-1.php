<!--TASK 3: CUSTOMIZE A GRID WIDGET -->
<script type="text/javascript">
    //Use this function to retrieve data from the OpenLibrary API.
    function getData(isbn) {
        var url = 'https://openlibrary.org/api/books?jscmd=data&bibkeys=ISBN:' + isbn;
        var html = '';

        $.get({
          url: url,
          dataType: "jsonp",
          success: function (data) {
            try {
                var book = data['ISBN:' + isbn];

                if(book) {
                    html += '<div class="details">';
                    if(book.cover) {
                        html += '<img style="float:left;padding:3px;" src="' + book.cover.small '"/>';
                    }
                    // STEP 1: CUSTOMIZE THE HTML HERE

                  if (book.url) {
                      html += '<p><a href="https://openlibrary.org/api/books?jscmd=data&bibkeys=ISBN' + book.isbn + '">' + book.url + '</a></p>';
                  }
                    //html += '<p>' + book.url + '</p>';
                    //html += '<p>' + book.ATTRIBUTE2 + '</p>';

                    html += '</div>';
                }

                $('#' + isbn).append(html);
            } catch (ex) {
                console.log(ex);
            };
          }
        });
    };
</script>

<table id="ReportGrid">
    <thead>
        <tr>
            <th width="10%">ID</th>
            <th>Title and Library Information</th>
            <th width="10%">Publisher</th>
            <th width="10%">Author</th>
            <th width"10%">Price</th>
            <!--STEP 2: ADD ADDITIONAL COLUMNS HERE-->
        </tr>
    </thead>
    <tbody>
        <?php
            require_once('login.php');

            $conn = new mysqli($hn, $un, $pw, $db);

            if ($conn->connect_error) die($conn->connect_error);

            //STEP 3: CUSTOMIZE THE QUERY BELOW (HINT: JOIN THE AUTHORS TABLE)
            $query = 'SELECT * FROM TBL_BOOKS'
                    . ' JOIN TBL_PUBLISHERS ON TBL_BOOKS.Publisher_ID = TBL_PUBLISHERS.Publisher_ID'

                    .  ' JOIN TBL_AUTHORS on TBL_BOOKS.Book_ID = TBL_AUTHORS.Author_ID'

                    . ' ORDER BY TBL_BOOKS.Title ASC;';

            $result = $conn->query($query);

            if(!$result) die($conn->error);

            $rowcount = $result->num_rows;

            for ($j = 0; $j < $rowcount; ++$j) {
                $result->data_seek($j);
                $row = $result->fetch_assoc();

                echo('<tr>');
                echo('  <td>' . $row['Book_ID'] . '</td>');
                echo('  <td id="' . $row['ISBN'] . '">');
                echo('      <span>' . $row['Title'] . '</span>');
                //The line below calls the getData function to mashup data from an API.
                echo('      <script>getData("' . $row['ISBN'] . '")</script>');
                echo('  </td>');

                echo('  <td>' . $row['Publisher_Name'] . '</td>');
                //STEP 4: ADD ADDITIONAL FIELDS HERE
                echo('  <td>' . $row['Author_Name'] . '</td>');
                  echo('  <td>' . $row['Price'] . '</td>');
                  echo('  </td>');
                echo('</tr>');
            }

            $result->close();

            $conn->close();
            ?>
    </tbody>
</table>
