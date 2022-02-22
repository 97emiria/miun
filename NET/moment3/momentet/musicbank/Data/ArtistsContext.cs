using Microsoft.EntityFrameworkCore;
using musicbank.Models;

namespace musicbank.Data
{
    public class ArtistsContext : DbContext
    {

        public ArtistsContext(DbContextOptions<ArtistsContext> options) : base(options)
        {

        }

        public DbSet<Artists> Artist { get; set; }
    }
}
