# WriteUp Generate Toolkit

> Mô tả: Bộ công cụ generate đề CTF tự động.
>
> Người viết: TraiOi
>
> Lần cuối chỉnh sửa: 21/03/2017

## Nội dung

* **[1. Giới thiệu](#gioi-thieu)**
* **[2. Changelog](#Changelog)**
* **[3. Writeup tree generate](#writeup-tree-generate)**
* **[4. Writeup readme generate](#writeup-readme-generate)**

----

<a name="gioi-thieu"></a>
### 1. Giới thiệu

**WriteUp Generate Toolkit** là bộ công cụ giúp generate đề thi CTF tự động giúp cho việc lưu đề CTF dễ dàng hơn, thao tác nhanh hơn thao tác bằng tay. <br>
Bộ công cụ gồm 2 phần là [Writeup tree generate](#writeup-tree-generate) và [Writeup readme generate](#writeup-readme-generate), trong đó:
* **WriteUp tree generate**: hỗ trợ việc generate cây thư mục để lưu đề CTF.
* **WriteUp readme generate**: hỗ trợ việc generate README.md, chuyển từ 1 file raw-text thành 1 file với form dễ nhìn hơn của challenge CTF.

<a name="Changelog"></a>
### 2. Changelog

**Author**: [TraiOi](https://github.com/TraiOi) <br>
**Operating System**: Gentoo 4.5.1 x86_64 <br>
**Perl**: Perl 5, version 5.24.1. 

**[21/03/2017]** Update ver0.01:
* Nothing ..

<a name="writeup-tree-generate"></a>
### 3. Writeup tree generate

* **Bước 1**: Thêm dòng `_tree.*` vào file `.gitignore`.
* **Bước 2**: Tạo 1 file tên là `_tree.ctf` với cấu trúc như sau: <br>

> Tên giải CTF <br>
> Tên mảng 1: Challenge 1(điểm), Challenge 2(điểm), Challenge 3(điểm) <br>
> Tên mảng 2: Challenge 1(điểm), Challenge 2(điểm) <br>
> Tên mảng 3: Challenge 1(điểm), Challenge 2(điểm), Challenge 3(điểm), Challenge 4(điểm) <br>

*Ví dụ:* <br>

> TraiOi CTF <br>
> Web: SQLInjection Basic(50), XSS Basic(100), So hard(300) <br>
> Pwnable: BoF(10), Format String(100), PoC(1000) <br>
> Cryptography: Caesar(20), DES(100), RSA 1(500), RSA 2(1000) <br>
> Forensics: HTTP(10), USB(100), Memdump(200)

* **Bước 3**: Chạy `./writeup-tree-generate.pl`.

<a name="writeup-readme-generate"></a>
### 4. Writeup readme generate

* **Bước 1**: Sau khi đã generate xong cây thư mục, công cụ `writeup-tree-generate` sẽ tự tạo file `_tree.README.md`. Thêm vào nội dung như sau: <br>


> Tên Challenge <br>
> Tên mảng|điểm <br>
> Thông tin đề bài. <br>

*Ví dụ:*

> SQLInjection Basic <br>
> Web|50 <br>
> Tính đã tạo một trang web như sau 12.34.56.78 <br>
> Nhưng do kiến thức có hạn tên trang web của Tính có lỗi rất lớn <br>
> Flag có dạng traioictf{} <br>

* **Bước 2**: Vào folder chứa file `_tree.README.md` cần đổi và chạy `writeup-readme-generate.pl`.
