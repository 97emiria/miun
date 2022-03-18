﻿// <auto-generated />
using System;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Infrastructure;
using Microsoft.EntityFrameworkCore.Storage.ValueConversion;
using ReceProject.Data;

#nullable disable

namespace ReceProject.Migrations
{
    [DbContext(typeof(ModelsContext))]
    partial class ModelsContextModelSnapshot : ModelSnapshot
    {
        protected override void BuildModel(ModelBuilder modelBuilder)
        {
#pragma warning disable 612, 618
            modelBuilder
                .HasAnnotation("ProductVersion", "6.0.3")
                .HasAnnotation("Relational:MaxIdentifierLength", 64);

            modelBuilder.Entity("ReceProject.Models.News", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<string>("Author")
                        .HasColumnType("longtext");

                    b.Property<string>("Hashtags")
                        .HasColumnType("longtext");

                    b.Property<string>("Header")
                        .IsRequired()
                        .HasColumnType("longtext");

                    b.Property<string>("ImageName")
                        .HasColumnType("longtext");

                    b.Property<DateTime>("LastUpdated")
                        .HasColumnType("datetime");

                    b.Property<DateTime>("Publish")
                        .HasColumnType("datetime");

                    b.Property<string>("Text")
                        .IsRequired()
                        .HasColumnType("longtext");

                    b.HasKey("Id");

                    b.ToTable("News");
                });

            modelBuilder.Entity("ReceProject.Models.Rent", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<string>("Name")
                        .IsRequired()
                        .HasColumnType("longtext");

                    b.Property<string>("Note")
                        .HasMaxLength(244)
                        .HasColumnType("varchar(244)");

                    b.Property<string>("Phone")
                        .IsRequired()
                        .HasColumnType("longtext");

                    b.Property<int>("RoomId")
                        .HasColumnType("int");

                    b.Property<string>("TimeRentedSince")
                        .HasColumnType("longtext");

                    b.HasKey("Id");

                    b.HasIndex("RoomId");

                    b.ToTable("Rents");
                });

            modelBuilder.Entity("ReceProject.Models.Room", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<string>("Description")
                        .IsRequired()
                        .HasColumnType("longtext");

                    b.Property<string>("ImageName")
                        .HasColumnType("longtext");

                    b.Property<DateTime>("LastUpdated")
                        .HasColumnType("datetime");

                    b.Property<string>("Name")
                        .IsRequired()
                        .HasColumnType("longtext");

                    b.Property<int?>("Price")
                        .IsRequired()
                        .HasColumnType("int");

                    b.HasKey("Id");

                    b.ToTable("Rooms");
                });

            modelBuilder.Entity("ReceProject.Models.Rent", b =>
                {
                    b.HasOne("ReceProject.Models.Room", "Room")
                        .WithMany()
                        .HasForeignKey("RoomId")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();

                    b.Navigation("Room");
                });
#pragma warning restore 612, 618
        }
    }
}
