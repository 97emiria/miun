// <auto-generated />
using System;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Infrastructure;
using Microsoft.EntityFrameworkCore.Storage.ValueConversion;
using musicBank.Data;

#nullable disable

namespace musicBank.Migrations
{
    [DbContext(typeof(MusicBankContext))]
    partial class MusicBankContextModelSnapshot : ModelSnapshot
    {
        protected override void BuildModel(ModelBuilder modelBuilder)
        {
#pragma warning disable 612, 618
            modelBuilder.HasAnnotation("ProductVersion", "6.0.2");

            modelBuilder.Entity("musicBank.Models.Album", b =>
                {
                    b.Property<int>("AlbumID")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("INTEGER");

                    b.Property<string>("AlbumName")
                        .IsRequired()
                        .HasColumnType("TEXT");

                    b.Property<int>("ArtistID")
                        .HasColumnType("INTEGER");

                    b.HasKey("AlbumID");

                    b.HasIndex("ArtistID");

                    b.ToTable("Albums");
                });

            modelBuilder.Entity("musicBank.Models.Artist", b =>
                {
                    b.Property<int>("ArtistID")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("INTEGER");

                    b.Property<string>("ArtistName")
                        .IsRequired()
                        .HasColumnType("TEXT");

                    b.Property<string>("Country")
                        .IsRequired()
                        .HasColumnType("TEXT");

                    b.HasKey("ArtistID");

                    b.ToTable("Artists");
                });

            modelBuilder.Entity("musicBank.Models.Borrow", b =>
                {
                    b.Property<int>("BorrowID")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("INTEGER");

                    b.Property<int>("AlbumID")
                        .HasColumnType("INTEGER");

                    b.Property<DateTime>("BorrowTime")
                        .HasColumnType("TEXT");

                    b.Property<int>("BorrowerID")
                        .HasColumnType("INTEGER");

                    b.Property<bool>("Rented")
                        .HasColumnType("INTEGER");

                    b.HasKey("BorrowID");

                    b.HasIndex("AlbumID");

                    b.HasIndex("BorrowerID");

                    b.ToTable("Borrow");
                });

            modelBuilder.Entity("musicBank.Models.Borrower", b =>
                {
                    b.Property<int>("BorrowerID")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("INTEGER");

                    b.Property<string>("NameBorrower")
                        .IsRequired()
                        .HasColumnType("TEXT");

                    b.Property<string>("Phone")
                        .IsRequired()
                        .HasColumnType("TEXT");

                    b.Property<DateTime>("RegisteredSince")
                        .HasColumnType("TEXT");

                    b.HasKey("BorrowerID");

                    b.ToTable("Borrower");
                });

            modelBuilder.Entity("musicBank.Models.Album", b =>
                {
                    b.HasOne("musicBank.Models.Artist", "Artist")
                        .WithMany()
                        .HasForeignKey("ArtistID")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();

                    b.Navigation("Artist");
                });

            modelBuilder.Entity("musicBank.Models.Borrow", b =>
                {
                    b.HasOne("musicBank.Models.Album", "Album")
                        .WithMany()
                        .HasForeignKey("AlbumID")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();

                    b.HasOne("musicBank.Models.Borrower", "Borrower")
                        .WithMany()
                        .HasForeignKey("BorrowerID")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();

                    b.Navigation("Album");

                    b.Navigation("Borrower");
                });
#pragma warning restore 612, 618
        }
    }
}
