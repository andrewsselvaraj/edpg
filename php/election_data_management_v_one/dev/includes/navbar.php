<style>
  .btn-primary {
  --bs-btn-color: #fff;
  --bs-btn-bg: #D81159;
  --bs-btn-border-color: #D81159;
  --bs-btn-hover-color: #fff;
  --bs-btn-hover-bg: #8F2D56;
  --bs-btn-hover-border-color: #8F2D56;
  --bs-btn-active-bg: #8F2D56;
  --bs-btn-active-border-color: #8F2D56;
  }

  </style>
<!-- nav class="navbar navbar-expand-lg bg-body-tertiary"-->
<!-- nav class="navbar navbar-expand-lg bg-dark navbar-dark" -->
<nav class="navbar navbar-expand-lg" style="background-color: #FFBC42;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <!--
        <li class="nav-item">
          <a class="nav-link" href="#">Constituencies</a>
        </li>
-->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Constituencies
          </a>
          <ul class="dropdown-menu">
            <!--li><a class="dropdown-item" href="ramnad.php">Ramnad</a></li-->
            <li><a class="dropdown-item" href="thiruvanandhapuram.php">Voter Search</a></li>
            <li><a class="dropdown-item" href="coimbatore.php">Coimbatore</a></li>
            
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">About data</a></li>
          </ul>
        </li>
        <!--
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
-->
      </ul>
      
      <!--form class="d-flex" role="search"-->
        <!--input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="searchInput" -->
        
        <!--button class="btn btn-outline-success" type="submit">Search</button -->
        <a href="logout_process.php"><button class="btn btn-primary" type="submit">Logout</button></a>
       
      <!--/form-->

    </div>
  </div>
</nav>
<script>
  function nav_search() {
    alert("No results found!");
  }
  </script>
<!--
<div id="searchResults">
       
    </div>
<script>
  const searchInput = document.getElementById("searchInput");
        const searchResults = document.getElementById("searchResults");

        searchInput.addEventListener("input", () => {
            const searchTerm = searchInput.value.toLowerCase();
            const allText = document.body.innerText.toLowerCase();
            const results = findAllOccurrences(allText, searchTerm);

            displayResults(results);
        });

        function findAllOccurrences(text, searchTerm) {
            const regex = new RegExp(searchTerm, "gi");
            const results = [];
            let match;
            while ((match = regex.exec(text))) {
                results.push(text.slice(match.index, match.index + searchTerm.length));
            }
            return results;
        }

        function displayResults(results) {
            if (results.length === 0) {
                searchResults.innerHTML = "<p>No results found.</p>";
            } else {
                const resultList = results.map(result => `<p>${result}</p>`).join("");
                searchResults.innerHTML = resultList;
            }
        }

        </script>
      -->