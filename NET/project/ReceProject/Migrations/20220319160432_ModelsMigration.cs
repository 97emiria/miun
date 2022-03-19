using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace ReceProject.Migrations
{
    public partial class ModelsMigration : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "News",
                columns: table => new
                {
                    Id = table.Column<int>(type: "INTEGER", nullable: false)
                        .Annotation("Sqlite:Autoincrement", true),
                    Header = table.Column<string>(type: "TEXT", nullable: false),
                    Text = table.Column<string>(type: "TEXT", nullable: false),
                    Hashtags = table.Column<string>(type: "TEXT", nullable: true),
                    Author = table.Column<string>(type: "TEXT", nullable: true),
                    ImageName = table.Column<string>(type: "TEXT", nullable: true),
                    Publish = table.Column<DateTime>(type: "TEXT", nullable: false),
                    LastUpdated = table.Column<DateTime>(type: "TEXT", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_News", x => x.Id);
                });

            migrationBuilder.CreateTable(
                name: "Rooms",
                columns: table => new
                {
                    Id = table.Column<int>(type: "INTEGER", nullable: false)
                        .Annotation("Sqlite:Autoincrement", true),
                    Name = table.Column<string>(type: "TEXT", nullable: false),
                    Price = table.Column<int>(type: "INTEGER", nullable: false),
                    Description = table.Column<string>(type: "TEXT", nullable: false),
                    ImageName = table.Column<string>(type: "TEXT", nullable: true),
                    LastUpdated = table.Column<DateTime>(type: "TEXT", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Rooms", x => x.Id);
                });

            migrationBuilder.CreateTable(
                name: "Rents",
                columns: table => new
                {
                    Id = table.Column<int>(type: "INTEGER", nullable: false)
                        .Annotation("Sqlite:Autoincrement", true),
                    Name = table.Column<string>(type: "TEXT", nullable: false),
                    Phone = table.Column<string>(type: "TEXT", nullable: false),
                    RoomId = table.Column<int>(type: "INTEGER", nullable: false),
                    Note = table.Column<string>(type: "TEXT", maxLength: 244, nullable: true),
                    RentedByEmployee = table.Column<string>(type: "TEXT", nullable: true),
                    TimeRentedSince = table.Column<DateTime>(type: "TEXT", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Rents", x => x.Id);
                    table.ForeignKey(
                        name: "FK_Rents_Rooms_RoomId",
                        column: x => x.RoomId,
                        principalTable: "Rooms",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateIndex(
                name: "IX_Rents_RoomId",
                table: "Rents",
                column: "RoomId");
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "News");

            migrationBuilder.DropTable(
                name: "Rents");

            migrationBuilder.DropTable(
                name: "Rooms");
        }
    }
}
