<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #1c4c6e;">
            <a class="navbar-brand text-white font-weight-bold" href="#home">Predict Movie Success</a>
        </nav>
        <div class="container" style="width: 100%;">
            <div id="home" style="margin-top: 3%;">
                <div class="container" >
                    <div class="row">
                        <div class="col-sm">
                            <div class="card" style="width: 30rem; padding: 1%;">
                                <?php
                                    $link = mysqli_connect('localhost', 'root', '', 'PMS');
                                    if(!$link) echo mysqli_error().'not connected';
                                    else {
                                        if (isset($_GET['submit'])) {
                                            $val = $_GET['val'];
                                            $q = "select * from data";
                                            $r = mysqli_query($link, $q);
                                            switch ($val) {
                                                case 'hit':
                                                    echo '<h5 class="font-weight-bold text-center bg-success" style="color: #1c4c6e;">HIT MOVIES</h5>';
                                                    while ($row=mysqli_fetch_array($r)) {
                                                        if ($row['star']>3) {
                                                            echo '<font class="text-success font-weight-bold">'.$row['name'].'</font>'.'<br>';
                                                        }
                                                    }
                                                    break;
                                                case 'flop':
                                                    echo '<h5 class="font-weight-bold text-center bg-danger" style="color: #1c4c6e;">FLOP MOVIES</h5>';
                                                    while ($row=mysqli_fetch_array($r)) {
                                                        if ($row['star']<4) {
                                                            echo '<font class="text-danger font-weight-bold">'.$row['name'].'</font>'.'<br>';
                                                        }
                                                    }
                                                    break;
                                                case 'review':
                                                    echo '<h5 class="font-weight-bold text-center bg-primary" style="color: #1c4c6e;">MOVIE REVIEWS</h5>';
                                                    while ($row=mysqli_fetch_array($r)) {
                                                        if (!empty($row['review'])) {
                                                            echo '<font class="text-primary font-weight-bold">'.$row['name'].'</font>'.$row['review'].'<br><br>';
                                                        }
                                                    }
                                                    break;
                                                default:
                                                    echo '<h5 class="font-weight-bold text-center bg-warning" style="color: #1c4c6e;">ALL MOVIES</h5>';
                                                    while ($row=mysqli_fetch_array($r)) {
                                                        switch ($row['star']) {
                                                            case 5:
                                                                echo '<font class="text-primary font-weight-bold">'.$row['name'].'</font>'.'<div class="progress">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: 100%">100%</div>
                                                                </div><br>';    
                                                                break;
                                                            case 4:
                                                                echo '<font class="text-primary font-weight-bold">'.$row['name'].'</font>'.'<div class="progress">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: 80%">80%</div>
                                                                </div><br>';    
                                                                break;
                                                            case 3:
                                                                echo '<font class="text-primary font-weight-bold">'.$row['name'].'</font>'.'<div class="progress">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: 60%">60%</div>
                                                                </div><br>';    
                                                                break;
                                                            case 2:
                                                                echo '<font class="text-primary font-weight-bold">'.$row['name'].'</font>'.'<div class="progress">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: 40%">40%</div>
                                                                </div><br>';    
                                                                break;
                                                            default:
                                                                echo '<font class="text-primary font-weight-bold">'.$row['name'].'</font>'.'<div class="progress">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: 20%">20%</div>
                                                                </div>';  
                                                                break;
                                                        }
                                                    }
                                                    break;
                                            }
                                        }
                                        if (isset($_GET['msubmit'])) {
                                            $movie = $_GET['movie'];
                                            $star = $_GET['rating'];
                                            $review = $_GET['mrevirew'];
                                            $query = "insert into data (name,star,review) values ('$movie','$star','$review')";
                                            $result = mysqli_query($link, $query);
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="card" style="width: 30rem;">
                                <div class="card-body">
                                  <h5 class="card-text">Choose your option...</h5>
                                  <form method='get'>
                                    <div class="form-group">
                                        <select class="form-control" name="val">
                                            <option value="all">All Movies</option>
                                            <option value="hit">HIT</option>
                                            <option value="flop">FLOP</option>
                                            <option value="review">Reviews</option>
                                        </select>
                                    </div>
                                    <input type='submit' name='submit' value='Submit' class='btn btn-outline-primary'/>
                                  </form><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container testimonial-group" style="margin-top: 3%;margin-bottom: 5%;">
                    <div class="row flex-nowrap">
                        <div class="col-sm">
                            <div class="card" style="width: 21rem;">
                                <img class="card-img-top" src="m1.jpeg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-text">ANTEBELLUM</h5>
                                    <p class="card-text">
                                        <span class="font-weight-bold">Genre: </span>Mystery And Thriller<br>
                                        <span class="font-weight-bold">Original language: </span>English<br>
                                        <span class="font-weight-bold">Cast: </span>Janella Monae, Eric Lange<br>
                                        <span class="font-weight-bold">Director: </span>Gerard Bush, Christopher Renz<br>
                                        <span class="font-weight-bold">Producer: </span>Raymond Mansfield, Sean McKittrick, Zev Foreman, Gerard Bush, Christopher Renz, Lezlie Wills<br>
                                    </p><hr>
                                    <form>
                                        <input type="hidden" name="movie" value="ANTEBELLUM" />
                                        <span class="star-rating">
                                            <input type="radio" name="rating" value="1"><i></i>
                                            <input type="radio" name="rating" value="2"><i></i>
                                            <input type="radio" name="rating" value="3"><i></i>
                                            <input type="radio" name="rating" value="4"><i></i>
                                            <input type="radio" name="rating" value="5"><i></i>
                                        </span>
                                        <div class="form-group">
                                            <textarea class="form-control" name="mrevirew" placeholder="Review... (Optional)"></textarea>
                                        </div>
                                        <input type="submit" name="msubmit" value="POST" class="btn btn-primary" />
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="card" style="width: 21rem;">
                                <img class="card-img-top" src="m2.webp" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-text">THE DEVIL ALL THE TIME</h5>
                                    <p class="card-text">
                                        <span class="font-weight-bold">Genre: </span>Crime, Mystery And Thriller, Drama<br>
                                        <span class="font-weight-bold">Original language: </span>English<br>
                                        <span class="font-weight-bold">Cast: </span>Robert Pattinson, Tom Holland<br>
                                        <span class="font-weight-bold">Director: </span>Antonio Campos<br>
                                        <span class="font-weight-bold">Producer: </span>Max Born, Jake Gyllenhaal, Riva Marker, Randall Poster<br>
                                    </p><hr>
                                    <form>
                                        <input type="hidden" name="movie" value="THE DEVIL ALL THE TIME" />
                                        <span class="star-rating">
                                            <input type="radio" name="rating" value="1"><i></i>
                                            <input type="radio" name="rating" value="2"><i></i>
                                            <input type="radio" name="rating" value="3"><i></i>
                                            <input type="radio" name="rating" value="4"><i></i>
                                            <input type="radio" name="rating" value="5"><i></i>
                                        </span>
                                        <div class="form-group">
                                            <textarea class="form-control" name="mrevirew" placeholder="Review... (Optional)"></textarea>
                                        </div>
                                        <input type="submit" name="msubmit" value="POST" class="btn btn-primary" />
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="card" style="width: 21rem;">
                                <img class="card-img-top" src="m3.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-text">I'M THINKING OF ENDING THINGS</h5>
                                    <p class="card-text">
                                        <span class="font-weight-bold">Genre: </span>Mystery And Thriller, Horror<br>
                                        <span class="font-weight-bold">Original language: </span>English<br>
                                        <span class="font-weight-bold">Cast: </span>Jesse Plemons, Jussie Buckley<br>
                                        <span class="font-weight-bold">Director: </span>Charlie Kaufman<br>
                                        <span class="font-weight-bold">Producer: </span>Stefanie Azpiazu, Anthony Bregman, Charlie Kaufman, Robert Salerno<br>
                                    </p><hr>
                                    <form>
                                        <input type="hidden" name="movie" value="IM THINKING OF ENDING THINGS" />
                                        <span class="star-rating">
                                            <input type="radio" name="rating" value="1"><i></i>
                                            <input type="radio" name="rating" value="2"><i></i>
                                            <input type="radio" name="rating" value="3"><i></i>
                                            <input type="radio" name="rating" value="4"><i></i>
                                            <input type="radio" name="rating" value="5"><i></i>
                                        </span>
                                        <div class="form-group">
                                            <textarea class="form-control" name="mrevirew" placeholder="Review... (Optional)"></textarea>
                                        </div>
                                        <input type="submit" name="msubmit" value="POST" class="btn btn-primary" />
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="card" style="width: 21rem;">
                                <img class="card-img-top" src="m4.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-text">THE OUTPOST</h5>
                                    <p class="card-text">
                                        <span class="font-weight-bold">Genre: </span>Drama, War<br>
                                        <span class="font-weight-bold">Original language: </span>English<br>
                                        <span class="font-weight-bold">Cast: </span>Scott Eastwood, Caleb Landry Jones<br>
                                        <span class="font-weight-bold">Director: </span>Rod Lurie<br>
                                        <span class="font-weight-bold">Producer: </span>Marc Frydman, Jeffrey Greenstein, Paul Michael Merryman, Paul Tamasy, Les Weldon, Jonathan Yunger<br>
                                    </p><hr>
                                    <form>
                                        <input type="hidden" name="movie" value="THE OUTPOST" />
                                        <span class="star-rating">
                                            <input type="radio" name="rating" value="1"><i></i>
                                            <input type="radio" name="rating" value="2"><i></i>
                                            <input type="radio" name="rating" value="3"><i></i>
                                            <input type="radio" name="rating" value="4"><i></i>
                                            <input type="radio" name="rating" value="5"><i></i>
                                        </span>
                                        <div class="form-group">
                                            <textarea class="form-control" name="mrevirew" placeholder="Review... (Optional)"></textarea>
                                        </div>
                                        <input type="submit" name="msubmit" value="POST" class="btn btn-primary" />
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="card" style="width: 21rem;">
                                <img class="card-img-top" src="m5.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-text">DOWNHILL</h5>
                                    <p class="card-text">
                                        <span class="font-weight-bold">Genre: </span>Drama, Comedy<br>
                                        <span class="font-weight-bold">Original language: </span>English<br>
                                        <span class="font-weight-bold">Cast: </span>Will Ferrel, Tom Holland<br>
                                        <span class="font-weight-bold">Director: </span>Nat Faxon, Julia Louis-Dreyfus<br>
                                        <span class="font-weight-bold">Producer: </span>Anthony Bregman, Julia Louis-Dreyfus, Stefanie Azpiazu<br>
                                    </p><hr>
                                    <form>
                                        <input type="hidden" name="movie" value="DOWNHILL" />
                                        <span class="star-rating">
                                            <input type="radio" name="rating" value="1"><i></i>
                                            <input type="radio" name="rating" value="2"><i></i>
                                            <input type="radio" name="rating" value="3"><i></i>
                                            <input type="radio" name="rating" value="4"><i></i>
                                            <input type="radio" name="rating" value="5"><i></i>
                                        </span>
                                        <div class="form-group">
                                            <textarea class="form-control" name="mrevirew" placeholder="Review... (Optional)"></textarea>
                                        </div>
                                        <input type="submit" name="msubmit" value="POST" class="btn btn-primary" />
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="card" style="width: 21rem;">
                                <img class="card-img-top" src="m6.jpeg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-text">THE SOCIAL DILEMMA</h5>
                                    <p class="card-text">
                                        <span class="font-weight-bold">Genre: </span>Documentary<br>
                                        <span class="font-weight-bold">Original language: </span>English<br>
                                        <span class="font-weight-bold">Cast: </span>Jeff Orlowski, Davis Coombe<br>
                                        <span class="font-weight-bold">Director: </span>Jeff Orlowski<br>
                                        <span class="font-weight-bold">Producer: </span>Larissa Rhodes<br>
                                    </p><hr>
                                    <form>
                                        <input type="hidden" name="movie" value="THE SOCIAL DILEMMA" />
                                        <span class="star-rating">
                                            <input type="radio" name="rating" value="1"><i></i>
                                            <input type="radio" name="rating" value="2"><i></i>
                                            <input type="radio" name="rating" value="3"><i></i>
                                            <input type="radio" name="rating" value="4"><i></i>
                                            <input type="radio" name="rating" value="5"><i></i>
                                        </span>
                                        <div class="form-group">
                                            <textarea class="form-control" name="mrevirew" placeholder="Review... (Optional)"></textarea>
                                        </div>
                                        <input type="submit" name="msubmit" value="POST" class="btn btn-primary" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<style>
    .testimonial-group > .row {
  overflow-x: auto;
}
.testimonial-group > .row > .col-sm {
  display: inline-block;
  float: none;
}
    .star-rating {
  font-size: 0;
  white-space: nowrap;
  display: inline-block;
  width: 250px;
  height: 50px;
  overflow: hidden;
  position: relative;
  background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjREREREREIiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
  background-size: contain;
}
.star-rating i {
  opacity: 0;
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 20%;
  z-index: 1;
  background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjRkZERjg4IiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
  background-size: contain;
}
.star-rating input {
  -moz-appearance: none;
  -webkit-appearance: none;
  opacity: 0;
  display: inline-block;
  width: 20%;
  height: 100%;
  margin: 0;
  padding: 0;
  z-index: 2;
  position: relative;
  cursor: pointer;
}
.star-rating input:hover + i,
.star-rating input:checked + i {
  opacity: 1;
}
.star-rating i ~ i {
  width: 40%;
}
.star-rating i ~ i ~ i {
  width: 60%;
}
.star-rating i ~ i ~ i ~ i {
  width: 80%;
}
.star-rating i ~ i ~ i ~ i ~ i {
  width: 100%;
}
::after,
::before {
  height: 100%;
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  text-align: center;
  vertical-align: middle;
}
</style>
