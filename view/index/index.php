<?php //echo '<pre>'; print_r($this->books); die;?>

<main>


    <div class="container-fluid pb-5">

        <article class="frst">

            <div id="zegar" class="d-inline-block mt-3"></div>
            <div class="w-100"></div>


            <h2 class="d-inline-block pt-5 pb-3 ">Najwyżej oceniane</h2>


            <div class="row shadow">


                <?php foreach ($this->books as $key => $book): ?>

                    <div class="oneModal col-lg-2 col-md-4 col-s-10 <?php if ($key == 0): ?>offset-lg-1<?php endif; ?> rounded">
                        <div class="opacity ">
                            <figure>

                                <a data-toggle="modal" data-id="<?php echo $book['id'] ?>"
                                   class="clearResponse fetchComments"
                                   data-target="#myModal<?php echo $book['id'] ?>" href="#"><img
                                            src="img/<?php echo $book['image'] ?>" alt="<?php echo $book['tytul'] ?>"
                                            class="img-fluid"></a>
                                <figcaption><?php echo $book['tytul'] ?></figcaption>

                            </figure>

                        </div>

                        <div id="myModal<?php echo $book['id'] ?>" data-type="book" data-id="<?php echo $book['id'] ?>"
                             class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h4 class="modal-title"><?php echo $book['tytul'] ?></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <img src="img/<?php echo $book['image'] ?>"
                                                     alt="<?php echo $book['tytul'] ?>"
                                                     class="img-fluid">
                                            </div>
                                            <div class="col-lg-8">
                                                <<p><b>Autor:</b> <?php echo $book['autor'] ?></p>
                                                <p><b>Rok wydania:</b> <?php echo $book['datawydania'] ?></p>
                                                <p><b>Gatunek:</b> <?php echo $book['gatunek'] ?></p>
                                                <hr/>
                                                <h3><b>OCENA: <?php echo $book['ocena'] ?></b></h3>
                                                <p>Liczba ocen: <?php echo $book['count'] ?> </p>

                                                <div class="col-10 offset-1 border rounded p-3 my-3 shadow">
                                                    <h4>A Ty jak oceniasz tę książkę?</h4>

                                                    <p class="response text-danger"></p>

                                                    <input type="number" min="1" max="10"
                                                           class="col-md-2 offset-md-5 col-6 offset-3 form-control my-2  shadow"
                                                           name="grade" value="">
                                                    <button type="submit"
                                                            class="col-md-4 btn btn-danger mb-2 addBookGrade">
                                                        Dodaj ocenę
                                                    </button>

                                                </div>
                                                <hr/>
                                            </div>
                                        </div>

                                        <div>

                                            <?php if (Session::get('user')) : ?>
                                                <p class="response1 text-secondary"></p>
                                                <div class="row mb-3">
                                                    <button type="submit"
                                                            class="col-lg-3 mr-2 offset-lg-3 col-md-4 offset-md-2 btn btn-light toRead">
                                                        <i class="fas fa-book"></i> Chcę przeczytać
                                                    </button>
                                                    <button type="submit"
                                                            class="col-lg-3 col-md-4 col-sm-8 btn btn-light read">
                                                        <i class="fas fa-star"></i> Przeczytane
                                                    </button>
                                                </div>
                                            <?php endif; ?>

                                            <button class="btn btn-secondary my-3 showDesc">Pokaż opis</button>
                                            <div class="showDesc"
                                                 style="display: none;"><?php echo $book['opis'] ?></div>


                                            <div class="commentSection" >
                                                <form method="post" class="commentForm col-10 offset-1 mt-5">

                                                    <div class="form-group">
                                                        <input type="hidden" name="parentID" value="0"/>
                                                        <input type="hidden" name="num" value="0"/>
                                                        <textarea name="commentContent"
                                                                  class="commentContent form-control"
                                                                  placeholder="Enter comment" rows="5"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" data-id="<?php echo $book['id'] ?>"
                                                                class="btn btn-secondary addComment" data-name="commentList" >Dodaj komentarz
                                                        </button>
                                                        <p class="commentMessage"></p>
                                                    </div>
                                                </form>

                                                <br/>
                                                <div id="displayComment"></div>
                                                <div id="commentsList"></div>

                                                <div class="card commentList col-lg-10 offset-lg-1 py-2 border"
                                                     id="com<?php echo $book['id'] ?>">

                                                </div>

                                            </div>


                                        </div>


                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>


                <?php endforeach; ?>


            </div>


            <h2 class="d-inline-block pt-5 pb-3">Najpopularniejsi autorzy</h2>

            <div class="row shadow mb-5">

                <?php foreach ($this->authors as $key => $author): ?>
                <div class="opacity col-lg-2 col-md-4 col-s-10 <?php if ($key == 0): ?>offset-lg-1<?php endif; ?>">
                    <figure>

                        <a data-toggle="modal" data-target="#Modal<?php echo $author['id'] ?>" href="#"><img
                                    src="img/<?php echo $author['image'] ?>" alt="<?php echo $author['autor'] ?>"
                                    class="img-fluid"></a>
                        <figcaption><?php echo $author['autor'] ?></figcaption>

                    </figure>

                </div>

                <div id="Modal<?php echo $author['id'] ?>" data-type="author" data-id="<?php echo $author['id'] ?>"
                     class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-lg-4">
                                        <img src="img/<?php echo $author['image'] ?>"
                                             alt="<?php echo $author['autor'] ?>"
                                             class="img-fluid">
                                    </div>
                                    <div class="col-lg-8">
                                        <h1 class="font-weight-bold"><?php echo $author['autor'] ?></h1>
                                        <hr/>
                                        <h3><b>OCENA: <?php echo $author['ocena'] ?></b></h3>
                                        <p>Liczba ocen: <?php echo $author['count'] ?></p>
                                        <br>
                                        <div class="col-10 offset-1 border rounded p-3 my-3 shadow">
                                            <h4>A Ty jak oceniasz tego autora?</h4>
                                            <p class="response text-danger"></p>


                                            <input type="number" min="1" max="10" id="author"
                                                   class="col-md-2 offset-md-5 form-control my-2  shadow" name="grade"
                                                   value="">
                                            <button type="submit" class="col-md-4 btn btn-danger mb-2 addAuthorGrade">
                                                Dodaj
                                                ocenę
                                            </button>


                                        </div>
                                        <hr/>
                                    </div>
                                </div>

                                <div>

                                    <button class="showDesc">Pokaż opis</button>
                                    <div class="showDesc" style="display: none;"><?php echo $author['opis'] ?></div>
                                </div>


                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                </button>
                            </div>

                        </div>
                    </div>
                </div>


                    <?php endforeach; ?>



                </div>

        </article>


    </div>


</main>




