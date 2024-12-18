<?php
$pengaduan_hash = $this->input->get('id_pengaduan');
?>
<div class="app-content-header"> 
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="d-flex align-items-center">
                    <a href="<?= site_url('pages3/home')?>" class="btn btn-primary"><i class="bi bi-arrow-left"></i></a>
                    <i class="bi bi-person-circle primary ms-4" style="color: #589BFF; font-size: 40px;"></i>
                    <span class="text-primary ms-3 align-text-center"><b><?= $pengaduan['username'] ?></b></span>
                </div>
            </div>
        </div>
    </div>
</div>

<hr style="height: 5px; background: black;">
<div class="app-content">
    <div class="row ms-auto me-auto justify-content-center w-auto mt-4">
        <div class="col-md-11 p-2">
            <div class="card shadow-lg border-0 rounded-lg">
                <div id="chat-content" class="card-body" style="height: 500px; overflow-y: scroll;">
                    <div class="mb-4">
                        <div class="card shadow-lg border-0 rounded-lg">
                            <div class="card-body rounded" style="background-color: #09B2F5;">
                                <div class="card-body" style="background-color: #09B2F5;">
                                    <div class="float-sm-end text-white"><?= $pengaduan['tgl_pengaduan'] ?></div>
                                    <form>
                                        <div class="form-floating mb-3 col-md-5">
                                            <input class="form-control" id="inputEmail" readonly type="text" placeholder="name@example.com" value="<?= $pengaduan['judul_pengaduan'] ?>" />
                                            <label for="floatingTextarea2">Judul : </label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <img src="<?= base_url('uploads/' . $pengaduan['gambar']); ?>" class="img-thumbnail w-25" alt="Bukti Foto" id="foto">
                                        </div>
                                        <div class="form-floating">
                                            <textarea class="form-control h-auto" readonly placeholder="Leave a comment here" id="floatingTextarea2"></textarea>
                                            <label for="floatingTextarea2"><?= $pengaduan['isi_laporan'] ?></label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="chat-messages">
                        <?php
                        $last_date = ''; 
                        foreach ($tanggapan as $t) {
                            if ($last_date != $t['tgl_tanggapan']) {
                                $last_date = $t['tgl_tanggapan'];
                                echo '<div class="text-center text-muted mb-3"><small>' . date('d/m/Y', strtotime($last_date)) . '</small></div>';
                            }

                            if ($t['sender_type'] == 'guru') {
                                echo '<div class="d-flex justify-content-end mb-3">';
                                echo '<div class="card text-bg-primary p-2 w-auto">';
                                echo '<p>' . htmlspecialchars($t['tanggapan']) . '</p>';

                                if (!empty($t['attachment'])) {
                                    $attachment_path = base_url('uploads/lampiran/' . $t['attachment']);
                                    $file_extension = strtolower(pathinfo($t['attachment'], PATHINFO_EXTENSION));
                                    $image_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                                    if (in_array($file_extension, $image_extensions)) {
                                        echo '<img src="' . $attachment_path . '" alt="Lampiran" class="img-fluid rounded my-2" style="max-width: 200px; max-height: 200px;">';
                                    } else {
                                        echo '<a href="' . $attachment_path . '" target="_blank" class="text-white">Lihat Lampiran</a>';
                                    }
                                }
                                echo '<small class="text-end">' . date('H:i ', strtotime($t['jam_menit'])) . '</small>';
                                echo '</div></div>';
                            } else {
                                echo '<div class="d-flex justify-content-start mb-3">';
                                echo '<div class="card text-bg-secondary p-2 w-auto">';
                                echo '<p>' . htmlspecialchars($t['tanggapan']) . '</p>';
                                if (!empty($t['attachment'])) {
                                    $attachment_path = base_url('uploads/lampiran/' . $t['attachment']);
                                    $file_extension = strtolower(pathinfo($t['attachment'], PATHINFO_EXTENSION));
                                    $image_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                                    if (in_array($file_extension, $image_extensions)) {
                                        echo '<img src="' . $attachment_path . '" alt="Lampiran" class="img-fluid rounded my-2" style="max-width: 200px; max-height: 200px;">';
                                    } else {
                                        echo '<a href="' . $attachment_path . '" target="_blank" class="text-white">Lihat Lampiran</a>';
                                    }
                                }
                                echo '<small class="text-end">' . date('H:i', strtotime($t['jam_menit'])) . '</small>';
                                echo '</div></div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row ms-auto me-auto justify-content-center w-auto mt-2">
        <div class="col-md-11 p-2">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body">
                    <form id="chat-form" action="<?= base_url('chat/kirim_pesan'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="row g-2">
                            <div class="col-md-10">
                                <textarea id="isi_pesan" class="form-control" name="isi_pesan" rows="2" placeholder="Ketik Pesan"></textarea>
                            </div>
                            <div class="col-md-2 d-flex justify-content-between align-items-center">
                                <label for="lampiran" class="btn btn-outline-secondary" id="lampiranLabel">Lamp. Foto</label>
                                <input type="file" id="lampiran" name="lampiran" class="d-none" onchange="updateLampiranLabel()">
                                <button type="button" id="kirim" class="btn btn-primary">KIRIM</button>
                            </div>
                        </div>
                        <input type="hidden" id="id_pengaduan" name="id_pengaduan" value="<?= $pengaduan_hash; ?>">
                        <input type="hidden" name="sender_type" value="guru"> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

   let previousMessageCount = 0; // Variabel untuk melacak jumlah pesan sebelumnya

function fetchMessages(scrollToBottom = false) {
    const id_pengaduan = document.getElementById('id_pengaduan').value;
    const chatContent = document.getElementById('chat-content');

    fetch(`<?= base_url('chat/get_messages_by_siswa'); ?>?id_pengaduan=${id_pengaduan}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const chatMessages = document.getElementById('chat-messages');
                const currentMessageCount = data.data.length; // Hitung jumlah pesan saat ini

                // Kosongkan chat sebelumnya
                chatMessages.innerHTML = ''; 
                data.data.forEach(t => {
                    const isGuru = t.sender_type === 'guru';
                    const chatClass = isGuru ? 'justify-content-end' : 'justify-content-start';
                    const cardClass = isGuru ? 'text-bg-primary' : 'text-bg-secondary';

                    let attachmentHTML = '';
                    if (t.attachment) {
                        const attachmentPath = `<?= base_url('uploads/lampiran/'); ?>${t.attachment}`;
                        const fileExtension = t.attachment.split('.').pop().toLowerCase();
                        const imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];

                        if (imageExtensions.includes(fileExtension)) {
                            attachmentHTML = `<img src="${attachmentPath}" alt="Lampiran" class="img-fluid rounded my-2" style="max-width: 200px; max-height: 200px;">`;
                        } else {
                            attachmentHTML = `<a href="${attachmentPath}" target="_blank" class="text-white">Lihat Lampiran</a>`;
                        }
                    }

                    const messageHTML = `
                        <div class="d-flex ${chatClass} mb-3">
                            <div class="card ${cardClass} p-2 w-auto">
                                <p>${t.tanggapan}</p>
                                ${attachmentHTML}
                                <small class="text-end">${t.jam_menit.slice(0, 5)}</small>
                            </div>
                        </div>
                    `;
                    chatMessages.innerHTML += messageHTML;
                });

                // Gulir ke bawah jika jumlah pesan berubah (chat baru masuk) atau jika scrollToBottom = true
                if (currentMessageCount > previousMessageCount || scrollToBottom) {
                    chatContent.scrollTop = chatContent.scrollHeight;
                }

                // Perbarui jumlah pesan sebelumnya
                previousMessageCount = currentMessageCount;
            }
        })
        .catch(error => console.error('Error fetching messages:', error));
}


document.getElementById('kirim').addEventListener('click', function() {
    const form = document.getElementById('chat-form');
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => { 
        response.json();
        document.getElementById('isi_pesan').value = '';
        document.getElementById('lampiran').value = '';
        document.getElementById('lampiranLabel').textContent = 'Lamp. Foto'; 
        fetchMessages();
    })
    .then(data => {
        if (data.status == 'success') { 
            document.getElementById('isi_pesan').value = '';
            document.getElementById('lampiran').value = '';
            document.getElementById('lampiranLabel').textContent = 'Lamp. Foto';
            
            fetchMessages();

            const chatContent = document.getElementById('chat-content');
            chatContent.scrollTop = chatContent.scrollHeight;
        } else {
            alert('Gagal mengirim pesan. Silakan coba lagi.');
        }
    })
    .catch(error => console.error('Error:', error));
});

function updateLampiranLabel() {
    const fileInput = document.getElementById('lampiran');
    const label = document.getElementById('lampiranLabel');

    if (fileInput.files && fileInput.files.length > 0) {
        label.textContent = fileInput.files[0].name;
    } else {
        label.textContent = 'Lamp. Foto';
    }
}


document.getElementById('chat-content').addEventListener('scroll', function() {
    const chatContent = document.getElementById('chat-content');
    const isScrolledToTop = chatContent.scrollTop === 0;
    if (isScrolledToTop) {
        console.log("Menggulir ke atas");
    }
});

setInterval(fetchMessages, 500);

</script>