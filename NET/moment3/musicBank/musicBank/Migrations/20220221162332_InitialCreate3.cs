using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace musicBank.Migrations
{
    public partial class InitialCreate3 : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "Relation",
                columns: table => new
                {
                    id = table.Column<int>(type: "INTEGER", nullable: false)
                        .Annotation("Sqlite:Autoincrement", true),
                    AlbumID = table.Column<string>(type: "TEXT", nullable: true),
                    ArtistID = table.Column<string>(type: "TEXT", nullable: true),
                    Albumsid = table.Column<int>(type: "INTEGER", nullable: false),
                    Artistsid = table.Column<int>(type: "INTEGER", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Relation", x => x.id);
                    table.ForeignKey(
                        name: "FK_Relation_Albums_Albumsid",
                        column: x => x.Albumsid,
                        principalTable: "Albums",
                        principalColumn: "id",
                        onDelete: ReferentialAction.Cascade);
                    table.ForeignKey(
                        name: "FK_Relation_Artists_Artistsid",
                        column: x => x.Artistsid,
                        principalTable: "Artists",
                        principalColumn: "id",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateIndex(
                name: "IX_Relation_Albumsid",
                table: "Relation",
                column: "Albumsid");

            migrationBuilder.CreateIndex(
                name: "IX_Relation_Artistsid",
                table: "Relation",
                column: "Artistsid");
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "Relation");
        }
    }
}
