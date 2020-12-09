  <?php include "nav.php" ?>


  <!DOCTYPE html>
  <html>

  <head></head>

  <body>
      <h1>User Lookup</h1>
      <form action="superadmin-lookup.php" method="post" name="participantlookupform">
          <label for="participantlookup">Participant Name</label>
          <input type="search" name="participantlookup" />
          <input type="submit" name="participantsearch" value="Search Participant" />
      </form>
      <br>
      <form action="superadmin-lookup.php" method="post" name="adminlookupform">
          <label for="adminlookup">Admin Name</label>
          <input type="search" name="adminlookup" />
          <input type="submit" name="adminsearch" value="Search Admin" />
      </form>
      <ul>
          <?php include "superadmin-lookupbackend.php" ?>
      </ul>

  </body>

  </html>
