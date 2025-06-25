# Mixtape - Customizable Playlist Manager

![Mixtape Logo](CD.jpeg)

Mixtape is a web application that allows users to create and manage customizable playlists using YouTube links. Users can create, edit, share, and play their music playlists with an intuitive interface.

## Features

- 🎵 **Playlist Management**: Create, edit, and delete playlists
- ▶️ **Music Player**: Play YouTube audio tracks with a customizable player
- 👥 **User System**: Sign up, log in, and manage profiles
- 👑 **Admin Dashboard**: Manage users and playlists (for admin users)
- 🔗 **Share Playlists**: Generate shareable links for your playlists
- 🎨 **Custom UI**: Dark theme with responsive design
- 📱 **Drag-and-Drop Player**: Move the music player anywhere on screen

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap
- **Backend**: PHP
- **Database**: MySQL
- **YouTube API**: For audio playback
- **Session Management**: PHP sessions for user authentication

## Installation

1. **Prerequisites**:
   - XAMPP/WAMP/MAMP installed
   - PHP 7.0+ 
   - MySQL 5.7+

2. **Setup**:
   ```bash
   git clone https://github.com/yourusername/mixtape.git
   cd mixtape
   ```

3. **Database Setup**:
   - Import the SQL files from the repository into your MySQL database
   - Update database connection details in `db_connection.php`

4. **Run**:
   - Place the project in your web server's root directory (e.g., `htdocs` for XAMPP)
   - Access via `http://localhost/mixtape`

## Usage

1. **Sign Up/Login**:
   - Register as a normal user or admin
   - Existing users can log in with their credentials

2. **Create Playlists**:
   - Click "Create Playlist"
   - Enter a name and YouTube links (one per line)
   - Save your playlist

3. **Play Music**:
   - Click "Play" on any playlist
   - Use the player controls (play/pause, skip, seek)

4. **Admin Features** (for admin users):
   - Manage all users and playlists
   - Edit or delete any content

## File Structure

```
mixtape/
├── admin.php              - Admin dashboard
├── MixTape.php            - Main user interface
├── SignIn.php             - Login/Signup page
├── update_user_form.php   - Edit user form
├── update_playlist_form.php - Edit playlist form
├── db_connection.php      - Database connection
├── CD.jpeg                - Default profile picture
├── shared_playlists.sql   - Database schema for shared playlists
└── users.sql              - Database schema for users
```

## Screenshots

![Login Page](screenshots/login.png)
*Login/Signup Interface*

![Playlist View](screenshots/playlists.png)
*User Playlist Management*

![Admin Dashboard](screenshots/admin.png)
*Admin Dashboard*

## Contributing

Contributions are welcome! Please fork the repository and create a pull request with your changes.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Future Enhancements

- [ ] Add collaborative playlist editing
- [ ] Implement playlist download feature
- [ ] Add social features (following, likes)
- [ ] Mobile app version

Enjoy creating your mixtapes! 🎶
