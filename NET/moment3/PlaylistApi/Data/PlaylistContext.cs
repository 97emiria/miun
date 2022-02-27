using Microsoft.EntityFrameworkCore;
using PlaylistApi.Models;

namespace PlaylistApi.Data {
    public class PlaylistContext : DbContext {

         public PlaylistContext(DbContextOptions options) : base(options) { 

        }

        public DbSet<Playlist> playlists { get; set; }


    }

}