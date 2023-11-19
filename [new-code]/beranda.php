<?php
session_start();
if (isset($_SESSION['email']) and isset($_SESSION['level'])) {

    include 'template/_header.php';
?>

    <div class="card rounded-bottom-0">
        <div class="card-header text-bg-primary fw-medium">
            BERANDA
        </div>
        <div class="card-body">
            <h5 class="card-title">Selamat Datang di Halaman Admin!</h5>
            <p class="card-text">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, quia. Omnis ad nulla, perspiciatis eius unde accusantium vero alias tenetur, tempora nemo dicta reprehenderit rem nobis sunt optio dolores corporis corrupti iste harum nihil quod? Doloribus, eaque vel. Repellat explicabo distinctio deleniti hic totam in similique non officia ut dolorum tempora, nostrum cupiditate ullam ab porro aspernatur doloremque, magnam itaque quasi nemo fugiat consequatur quaerat laudantium quam. Ex aperiam consequuntur fuga! Similique temporibus ducimus aliquam, laborum sint neque dignissimos facilis voluptates ea tempore alias vel earum ipsam doloribus! Asperiores exercitationem molestias, nihil nesciunt, a eaque ad in eius fuga maiores laboriosam, obcaecati maxime ut accusamus quis possimus? Voluptas error fugit optio. Distinctio iusto at eveniet! Molestiae nobis dolorum enim! Totam, soluta consequatur fuga quisquam explicabo magnam doloremque ex quis reprehenderit porro eum minima adipisci ratione rem itaque tempore mollitia architecto. Cumque similique consequuntur nostrum ut enim quibusdam quisquam. Accusamus, tenetur.
            </p>
            <p class="card-text">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, quia. Omnis ad nulla, perspiciatis eius unde accusantium vero alias tenetur, tempora nemo dicta reprehenderit rem nobis sunt optio dolores corporis corrupti iste harum nihil quod? Doloribus, eaque vel. Repellat explicabo distinctio deleniti hic totam in similique non officia ut dolorum tempora, nostrum cupiditate ullam ab porro aspernatur doloremque, magnam itaque quasi nemo fugiat consequatur quaerat laudantium quam. Ex aperiam consequuntur fuga! Similique temporibus ducimus aliquam, laborum sint neque dignissimos facilis voluptates ea tempore alias vel earum ipsam doloribus! Asperiores exercitationem molestias, nihil nesciunt, a eaque ad in eius fuga maiores laboriosam, obcaecati maxime ut accusamus quis possimus? Voluptas error fugit optio. Distinctio iusto at eveniet! Molestiae nobis dolorum enim! Totam, soluta consequatur fuga quisquam explicabo magnam doloremque ex quis reprehenderit porro eum minima adipisci ratione rem itaque tempore mollitia architecto. Cumque similique consequuntur nostrum ut enim quibusdam quisquam. Accusamus, tenetur.
            </p>
            <a href="mahasiswa-data.php" class="btn btn-primary">Data Mahasiswa</a>
        </div>
    </div>

<?php
    include 'template/_footer.php';
} else {
    echo '<div style="font-family: Arial, Helvetica, sans-serif; font-size: large; text-align: center; color: red; margin-top: 5rem;">
            <h5>Tidak dapat mengakses halaman ini, silahkan login terlebih dahulu. <a href="login.php">LOGIN</a></h5>
        </div>';
} ?>