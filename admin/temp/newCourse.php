
                <h1 class="h3 text-white text-center p-1 mb-4">Add curso</h1>
                <form action="../../controller/newCourse.php" method="post" enctype="multipart/form-data">
                    <div class="container row mx-auto">
                        <div class="form-group col-12">
                            <label for="name">Nome:</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nome do curso">
                        </div>
                        <div class="form-group col-12">
                            <label for="student-company">Empresa:</label>
                            <select class="custom-select" name="company" id="student-company">
                                <option selected disabled>Empresa...</option>
                                <!-- VALUE = COMPANY ID AND THE TEXT THE NAME OF COMPANY -->
                                <option value="1">One</option> 
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <input type="text" name="inicial_name" placeholder="Digite o nome do primeiro slide!">
                        <div class="form-group col-12 col-lg-6">
                            <label for="inicial-slide">Slide da apresentação:</label>
                            <input type="file" class="form-control-file" name="inicial_slide" id="inicial-slide">
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="inicial-audio">Audio da apresentação:</label>
                            <input type="file" class="form-control-file" name="inicial_audio" id="inicial-audio">
                        </div>
                        <input type="text" name="end_name" placeholder="Digite o nome do ultimo slide!">
                        <div class="form-group col-12 col-lg-6">
                            <label for="end-slide">Slide da conclusão:</label>
                            <input type="file" class="form-control-file" name="end_slide" id="end-slide">
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="end-audio">Audio da conclusão:</label>
                            <input type="file" class="form-control-file" name="end_audio" id="end-audio">
                        </div>
                        <div class="form-group col-12">
                            <input type="submit" name="action" class="btn save text-white" value="Salvar">
                        </div>
                    </div>
                </form>
            