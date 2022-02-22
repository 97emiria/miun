using Microsoft.EntityFrameworkCore;
using musicBank.Models;

namespace musicBank.Data
{
    public class MusicBankContext : DbContext
    {
        public MusicBankContext(DbContextOptions<MusicBankContext> options) : base(options)
        {

        }

        public DbSet<Albums> Albums { get; set; }
        public DbSet<Artists> Artists { get; set; }
        public DbSet<Relation> Relation { get; set; }

    }
}
