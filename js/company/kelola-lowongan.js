const baseUrl = "..";
async function showAllManagedLowongan() {
    const response = await fetch(
        `${baseUrl}/controller/lowongan-controller.php?show_all_managed`

    );
    return response.json();
};

function doShowManagedLowongan() {
    const managedLowonganDiv = document.querySelector(".lowongan-list");
    showAllManagedLowongan()
        .then((data) => {
            managedLowonganDiv.innerHTML = `
                <div class="judul">
                    <h2>Daftar Lowongan Pekerjaan</h2>
                    <a href="tambah-lowongan.php">
                        <h3><i class="fa fa-plus-square" aria-hidden="true"></i></h3>
                    </a>
                </div>
                <br>
            `;
            if (data.length == 0) {
                managedLowonganDiv.innerHTML += "<p>Daftar Lowongan Pekerjaan Kosong.</p>"
                managedLowonganDiv.className += " empty";
            } else {
                data.forEach(row => {
                    const deadline = new Date(row['deadline']);

                    managedLowonganDiv.innerHTML += `
                    <div class="card">
                        <div class="card-info company-image-wrapper">
                        <img class="company-pic" src="../assets/images/company-profile/${row['image']}" alt="Company Logo">
                    </div>
                        <div class="card-info card-detail">
                            <h3>${row['nama']} <span class="${row['status'] == "OPEN" ? "bg-green" : "bg-red"}">${row['status']} </span></h3>
                            <div class="additional-info">
                                <span class="deadline">Deadline: ${deadline.getDate()}-${deadline.getMonth()+1}-${deadline.getFullYear()}</span>
                                <span class="gaji">Rp. ${row['gaji']}</span>
                            </div>
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i> ${row['lokasi']}</p>
                        </div>
                        <div class="card-info action">
                            <a href="../company/edit-lowongan.php?id=${row['id']}" class="edit-btn" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    `;
                });
            }
        })
        .catch((err) => {
            alert(`Load Data Gagal.`);
        });
}

document.addEventListener("DOMContentLoaded", () => {
    doShowManagedLowongan();
});