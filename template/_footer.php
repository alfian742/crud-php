    <!-- End of content -->
    </div>
    </div>
    <!-- End of list menu & content -->

    <!-- Footer -->
    <footer class="text-center">
        <div class="card rounded-bottom-0">
            <div class="card-body">
                Copyright &copy; <?= date('Y'); ?> Universitas Teknologi Mataram
            </div>
        </div>
    </footer>
    <!-- End of footer -->
    </div>

    <!-- dataTables js -->
    <script src="vendor/datatables/js/jquery-3.3.1.slim.min.js"></script>
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/js/dataTables.bootstrap4.min.js"></script>

    <!-- Bootstrap js bundle with @popper -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom script -->
    <script>
        // dataTables
        $(document).ready(function() {
            $('#example').DataTable();
        });

        // Preview image
        function previewImage() {
            const inputImgeFile = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview');

            const inputFile = inputImgeFile;

            if (inputFile) {
                const fileReader = new FileReader();
                fileReader.readAsDataURL(inputFile.files[0]);

                fileReader.onload = function(e) {
                    imgPreview.src = e.target.result;
                }
            }
        }
    </script>
    </body>

    </html>