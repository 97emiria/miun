﻿// <auto-generated />
using System;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Infrastructure;
using Microsoft.EntityFrameworkCore.Migrations;
using Microsoft.EntityFrameworkCore.Storage.ValueConversion;
using ReceProject.Data;

#nullable disable

namespace ReceProject.Migrations
{
    [DbContext(typeof(ModelsContext))]
    [Migration("20220320091416_ModelsMigration")]
    partial class ModelsMigration
    {
        protected override void BuildTargetModel(ModelBuilder modelBuilder)
        {
#pragma warning disable 612, 618
            modelBuilder.HasAnnotation("ProductVersion", "6.0.3");

            modelBuilder.Entity("ReceProject.Models.News", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("INTEGER");

                    b.Property<string>("Author")
                        .HasColumnType("TEXT");

                    b.Property<string>("Hashtags")
                        .HasColumnType("TEXT");

                    b.Property<string>("Header")
                        .IsRequired()
                        .HasColumnType("TEXT");

                    b.Property<string>("ImageName")
                        .HasColumnType("TEXT");

                    b.Property<DateTime>("LastUpdated")
                        .HasColumnType("TEXT");

                    b.Property<string>("Publish")
                        .IsConcurrencyToken()
                        .ValueGeneratedOnAddOrUpdate()
                        .HasColumnType("TEXT");

                    b.Property<string>("Text")
                        .IsRequired()
                        .HasColumnType("TEXT");

                    b.HasKey("Id");

                    b.ToTable("News");
                });

            modelBuilder.Entity("ReceProject.Models.Rent", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("INTEGER");

                    b.Property<string>("Name")
                        .IsRequired()
                        .HasColumnType("TEXT");

                    b.Property<string>("Note")
                        .HasMaxLength(244)
                        .HasColumnType("TEXT");

                    b.Property<string>("Phone")
                        .IsRequired()
                        .HasColumnType("TEXT");

                    b.Property<string>("RentedByEmployee")
                        .HasColumnType("TEXT");

                    b.Property<int>("RoomId")
                        .HasColumnType("INTEGER");

                    b.Property<DateTime>("TimeRentedSince")
                        .IsConcurrencyToken()
                        .ValueGeneratedOnAddOrUpdate()
                        .HasColumnType("TEXT");

                    b.HasKey("Id");

                    b.HasIndex("RoomId");

                    b.ToTable("Rents");
                });

            modelBuilder.Entity("ReceProject.Models.Room", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("INTEGER");

                    b.Property<string>("Description")
                        .IsRequired()
                        .HasColumnType("TEXT");

                    b.Property<string>("ImageName")
                        .HasColumnType("TEXT");

                    b.Property<DateTime>("LastUpdated")
                        .HasColumnType("TEXT");

                    b.Property<string>("Name")
                        .IsRequired()
                        .HasColumnType("TEXT");

                    b.Property<int?>("Price")
                        .IsRequired()
                        .HasColumnType("INTEGER");

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
