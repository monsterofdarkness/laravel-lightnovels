            <footer>
                <div class="container">
                    <span class="right-footer">Liên hệ: <a href="mailto:0306191431@caothang.edu.vn" target="_blank" style="color: #5fff46">Shinokawa</a></span>
                    <span class="left-footer">© ShinoNovel 2022 - Website đọc Tiểu Thuyết</span>
                </div>
            </footer>
        <!-- Scripts -->

        <script type="text/javascript">
            const toggle = document.querySelector('.toggle');
            const main_all = document.querySelector('.main_all');

            toggle.onclick = function() {
                toggle.classList.toggle('active');
                main_all.classList.toggle('dark');

                var theme;

                if(toggle.classList.contains('active')) {
                    theme = "DARK";
                } else {
                    theme = "LIGHT";
                }

                localStorage.setItem("PageTheme", JSON.stringify(theme));
            }

            let GetTheme = JSON.parse(localStorage.getItem("PageTheme"));

            if(GetTheme === "DARK") {
                main_all.classList.toggle('dark');
                toggle.classList.toggle('active');
            }

        </script>
        
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('rating/starrr.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>        
        
        <script type="text/javascript">
            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                autoplay: true,
                autoplayHoverPause: true,
                autoplayTimeout: 3000,
                smartSpeed: 500,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:4
                    }
                }
            })
        </script>
        <script type="text/javascript">
            $('.select-chapter').on('change', function(){
                var url = $(this).val();
                if(url) {
                    window.location = url;
                }
                return false;
            });

            current_chapter();
            function current_chapter() {
                var url = window.location.href;
                $('.select-chapter').find('option[value="' + url + '"]').attr("selected", true);
            }

        </script>

<script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('status'))
    <script>
        Swal.fire({
            icon: 'success',
            title: "{{ session('status') }}",
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif       
        
<!-- @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Lỗi...',
            text: '',
            showConfirmButton: false,
        })
    </script>
@endif -->

    <script type="text/javascript">
        CKEDITOR.replace('chapter_content');
        CKEDITOR.replace('summary_content');
        // CKEDITOR.replace('comment_content');
        CKEDITOR.replace('topic_content');
    </script>


    <script type="text/javascript">
        flatpickr("#birthday-pk", {
            dateFormat: "d-m-Y",
        });
    </script>
    

    <script src="../rating/starrr.js"></script>

    <script>
        $('#star1').starrr({
        change: function(e, value){
            if (value) {
                // $('.your-choice-was').show();
                // $('.your-novel-is').show();
                $('.choice').text(value);
                $('#rating_star').val(value);
                $('#formRating').submit();
            } else {
                $('.your-choice-was').hide();
            }
        }
        });

        $('#star2').starrr({
        change: function(e, value){
            if (value) {
                Swal.fire({
                    icon: 'error',
                    title: 'Không thể đánh giá...',
                    text: 'Bạn cần đăng nhập để đánh giá!',
                    showConfirmButton: false,
                    footer: '<a href="{{ route('log-in') }}">Đăng nhập</a>'
                })
            } else {
                $('.your-choice-was').hide();
            }
        }
        });

    </script>
        
    <script>
        function submitFavorite() {
            $('#formFavorite').submit();
        }

        function submitFavoriteFail() {
            Swal.fire({
                icon: 'error',
                title: 'Không thể thêm vào yêu thích...',
                text: 'Bạn cần đăng nhập để thêm truyện vào danh sách yêu thích!',
                showConfirmButton: false,
                footer: '<a href="{{ route('log-in') }}">Đăng nhập</a>'
            })
        }

        function submitRemoveFavoriteList() {
            $('#removeFormFavorite').submit();
        }

        function submitReportFail() {
            Swal.fire({
                icon: 'error',
                title: 'Không thể báo cáo truyện...',
                text: 'Bạn cần đăng nhập để báo cáo truyện!',
                showConfirmButton: false,
                footer: '<a href="{{ route('log-in') }}">Đăng nhập</a>'
            })
        }

    </script>

    <script>
        let isShowCmt = true;
        $(document).on('click', '.do-reply', function(ev) {
            ev.preventDefault();
            var id = $(this).data('id');
            var reply_form = '.reply-form-' + id;
            if(isShowCmt) {
                $('.replyForm').slideUp();
                $(reply_form).slideDown();
                isShowCmt = false;
            }
            else {
                $(reply_form).slideUp();
                isShowCmt = true;
            }
        })
    </script>

    
    <script type="text/javascript">
        function ChangeToSlug()
            {
                var slug;
            
                //Lấy text từ thẻ input title 
                slug = document.getElementById("slug").value;
                slug = slug.toLowerCase();
                //Đổi ký tự có dấu thành không dấu
                    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                    slug = slug.replace(/đ/gi, 'd');
                    //Xóa các ký tự đặt biệt
                    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                    //Đổi khoảng trắng thành ký tự gạch ngang
                    slug = slug.replace(/ /gi, "-");
                    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                    slug = slug.replace(/\-\-\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-/gi, '-');
                    //Xóa các ký tự gạch ngang ở đầu và cuối
                    slug = '@' + slug + '@';
                    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                    //In slug ra textbox có id “slug”
                document.getElementById('convert_slug').value = slug;
            }
    </script>

    <script type="text/javascript">
        function ChangeToSlugAuthor()
            {
                var slugAuthor;
            
                //Lấy text từ thẻ input title 
                slugAuthor = document.getElementById("slug_author").value;
                slugAuthor = slugAuthor.toLowerCase();
                //Đổi ký tự có dấu thành không dấu
                    slugAuthor = slugAuthor.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                    slugAuthor = slugAuthor.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                    slugAuthor = slugAuthor.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                    slugAuthor = slugAuthor.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                    slugAuthor = slugAuthor.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                    slugAuthor = slugAuthor.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                    slugAuthor = slugAuthor.replace(/đ/gi, 'd');
                    //Xóa các ký tự đặt biệt
                    slugAuthor = slugAuthor.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                    //Đổi khoảng trắng thành ký tự gạch ngang
                    slugAuthor = slugAuthor.replace(/ /gi, "-");
                    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                    slugAuthor = slugAuthor.replace(/\-\-\-\-\-/gi, '-');
                    slugAuthor = slugAuthor.replace(/\-\-\-\-/gi, '-');
                    slugAuthor = slugAuthor.replace(/\-\-\-/gi, '-');
                    slugAuthor = slugAuthor.replace(/\-\-/gi, '-');
                    //Xóa các ký tự gạch ngang ở đầu và cuối
                    slugAuthor = '@' + slugAuthor + '@';
                    slugAuthor = slugAuthor.replace(/\@\-|\-\@|\@/gi, '');
                    //In slug ra textbox có id “slug”
                document.getElementById('convert_slug_author').value = slugAuthor;
            }
    </script>

<script type="text/javascript">
        function ChangeToSlugTopicTitle()
            {
                var slugTopicTitle;
            
                //Lấy text từ thẻ input title 
                slugTopicTitle = document.getElementById("slug_title").value;
                slugTopicTitle = slugTopicTitle.toLowerCase();
                //Đổi ký tự có dấu thành không dấu
                    slugTopicTitle = slugTopicTitle.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                    slugTopicTitle = slugTopicTitle.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                    slugTopicTitle = slugTopicTitle.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                    slugTopicTitle = slugTopicTitle.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                    slugTopicTitle = slugTopicTitle.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                    slugTopicTitle = slugTopicTitle.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                    slugTopicTitle = slugTopicTitle.replace(/đ/gi, 'd');
                    //Xóa các ký tự đặt biệt
                    slugTopicTitle = slugTopicTitle.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                    //Đổi khoảng trắng thành ký tự gạch ngang
                    slugTopicTitle = slugTopicTitle.replace(/ /gi, "-");
                    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                    slugTopicTitle = slugTopicTitle.replace(/\-\-\-\-\-/gi, '-');
                    slugTopicTitle = slugTopicTitle.replace(/\-\-\-\-/gi, '-');
                    slugTopicTitle = slugTopicTitle.replace(/\-\-\-/gi, '-');
                    slugTopicTitle = slugTopicTitle.replace(/\-\-/gi, '-');
                    //Xóa slugTopicTitlecác ký tự gạch ngang ở đầu và cuối
                    slugTopicTitle = '@' + slugTopicTitle + '@';
                    slugTopicTitle = slugTopicTitle.replace(/\@\-|\-\@|\@/gi, '');
                    //In slug ra textbox có id “slug”
                document.getElementById('convert_slug_title').value = slugTopicTitle;
            }
    </script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>        
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
