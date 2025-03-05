<script>
     $('#submit').on('click', function(ev) {
            var content = tinymce.get("content").getContent();
            var data = {
                author_id : '<?php echo e($user->id); ?>',
                name : $('#name').val(),
                category_id: $('#category_id').val(),
                short_content: $('#short_content').val(),
                content : content,
                thumbnail: Path_main_image,
                keyword : allKeywords,
            }
            console.log(data);
            $.ajax({
                type: "post",
                dataType: "json",
                data: data,
                url: `<?php echo e(route('news.api.store')); ?>`,
                success: function(data) {
                    slug = data.slug;
                    window.location="<?php echo e(route('news.confirm_add', ':slug')); ?>".replace(':slug', slug)

                },
                error: function(e) {
                    if (typeof e.responseJSON.errors !== 'undefined') {
                        for (const [key, value] of Object.entries(e.responseJSON.errors)) {
                            makeToast(value, "red");
                        }

                    }else {
                            makeToast(e.responseJSON.error, "red");
                            console.log(e.responseJSON.error);
                        }

                }
            });
        });
</script><?php /**PATH D:\tai_lieu_hoc_tap\nhap_mon_cnpm\Web_QL_PhongTro_L10\resources\views/js/news/store.blade.php ENDPATH**/ ?>