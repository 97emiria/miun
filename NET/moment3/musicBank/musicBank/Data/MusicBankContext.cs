using Microsoft.EntityFrameworkCore;
using musicBank.Models;

namespace musicBank.Data
{
    public class MusicBankContext : DbContext
    {
        public MusicBankContext(DbContextOptions<MusicBankContext> options) : base(options)
        {

        }

        public DbSet<Album> Albums { get; set; }
        public DbSet<Artist> Artists { get; set; }
        public DbSet<musicBank.Models.Borrower> Borrower { get; set; }
        public DbSet<musicBank.Models.Borrow> Borrow { get; set; }

    }
}
