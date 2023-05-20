<?php

namespace App\Helpers\General;

class EndPoints {
    private const sourceApi = 'https://api.emiratesesports.net/';

    // Auth Api
    public const loginApi                           = self::sourceApi . 'auth/login';
    public const Weather                            = self::sourceApi . 'WeatherForecast';
    public const ChangePlayerPassword               = self::sourceApi . 'api/Players/ResetClientPassword';
    public const saveVerificationCodeApi            = self::sourceApi . 'api/Administration/ForgetPassword';
    public const ResetPasswordApi                   = self::sourceApi . 'api/Administration/ResetPasswordConfirmation';
    // Managers Api
    public const GetManagersDetailsApi              = self::sourceApi . 'api/Managers/';
    public const GetManagersInfoApi                 = self::sourceApi . 'api/Managers/GetInfo';
    public const registerManagerApi                 = self::sourceApi . 'api/Managers/Register';
    public const GetClientManagersApi               = self::sourceApi . 'api/Managers/GetClientManagers';
    public const ManagersUpdateInfoApi              = self::sourceApi . 'api/Managers/UpdateInfo';
    public const GetClientManagersRequestsApi       = self::sourceApi . 'api/Managers/GetClientManagerRequests';
    public const ChangeManagerPassword              = self::sourceApi . 'api/Managers/ResetClientPassword';

    //Commentators
    public const GetCommentatorsDetailsApi              = self::sourceApi . 'api/Commentators/';
    public const GetCommentatorsInfoApi                 = self::sourceApi . 'api/Commentators/GetInfo';
    public const registerCommentatorsApi                = self::sourceApi . 'api/Commentators/Register';
    public const CommentatorsUpdateInfoApi              = self::sourceApi . 'api/Commentators/UpdateInfo';
    public const ChangeCommentatorsPassword             = self::sourceApi . 'api/Commentators/ResetClientPassword';

    //Content-Creator
    public const GetContentCreatorsDetailsApi              = self::sourceApi . 'api/ContentCreators/';
    public const GetContentCreatorsInfoApi                 = self::sourceApi . 'api/ContentCreators/GetInfo';
    public const registerContentCreatorsApi                 = self::sourceApi . 'api/ContentCreators/Register';
    public const ContentCreatorsUpdateInfoApi              = self::sourceApi . 'api/ContentCreators/UpdateInfo';
    public const ChangeContentCreatorsPassword                 = self::sourceApi . 'api/ContentCreators/ResetClientPassword';

    // Follower Api
    public const GetFollowerInfoApi                 = self::sourceApi . 'api/WebSiteFollowers/GetInfo';
    public const registerFollowerApi                = self::sourceApi . 'api/WebSiteFollowers/Register';
    public const ChangeFollowerPassword               = self::sourceApi . 'api/WebSiteFollowers/ResetClientPassword';

    // Players Api
    public const GetAnyPlayerInfoApi                = self::sourceApi . 'api/Players/';
    public const GetPlayerInfoApi                   = self::sourceApi . 'api/Players/GetInfo';
    public const GetPlayerIndexApi                  = self::sourceApi . 'api/Players/IndexGet';
    public const registerPlayersApi                 = self::sourceApi . 'api/Players/Register';
    public const PlayersApi                         = self::sourceApi . 'api/Players';
    public const GetClientPlayerRequestsApi         = self::sourceApi . 'api/Players/GetClientPlayerRequests';
    public const SearchForPlayerApi                 = self::sourceApi . 'api/Players/GetFreePlayersBy?';
    // Get All Players For Clubs Or Academy depending on the user token
    public const GetClientPlayersApi                = self::sourceApi . 'api/Players/GetClientPlayers';
    public const GetPlayerOfMonthsApi               = self::sourceApi . 'api/PlayerOfMonths';
    // public const GetPlayerOfMonthsApi               = self::sourceApi . 'api/PlayerOfMonths';

    // Coach Api
    public const CoachsApi                          = self::sourceApi . 'api/Coaches';
    public const GetCoachDetailsApi                 = self::sourceApi . 'api/Coaches/';
    public const GetCoachInfoApi                    = self::sourceApi . 'api/Coaches/GetInfo';
    public const registerCoachesApi                 = self::sourceApi . 'api/Coaches/Register';
    public const GetClientCoachesApi                = self::sourceApi . 'api/Coaches/GetClientCoaches';
    public const ChangeCoachPassword                = self::sourceApi . 'api/Coaches/ResetClientPassword';
    public const GetClientCoachRequestsApi         = self::sourceApi . 'api/Coaches/GetClientCoachRequests';

    // Clubs Api
    public const GetClubsInfoApi                    = self::sourceApi . 'api/Clubs/GetInfo';
    public const registerClubsApi                   = self::sourceApi . 'api/Clubs/Register';
    public const GetClubsApi                        = self::sourceApi . 'api/Clubs';
    public const GetClubTypesApi                    = self::sourceApi . 'api/ClubTypes/GetAll';
    public const GetClubTypesGetAllApi              = self::sourceApi . 'api/ClubTypes/IndexGet';
    public const ChangeClubPassword                 = self::sourceApi . 'api/Clubs/ResetClientPassword';

    // Academies Api
    public const GetAcademiesInfoApi                = self::sourceApi . 'api/Academies/GetInfo';
    public const registerAcademiesApi               = self::sourceApi . 'api/Academies/Register';
    public const ChangeAcademiesPassword            = self::sourceApi . 'api/Academies/ResetClientPassword';
    public const GetAcademiesApi                    = self::sourceApi . 'api/Academies';

    // Referees Api
    public const RefereesApi                        = self::sourceApi . 'api/Referees';
    public const GetRefereesInfoApi                 = self::sourceApi . 'api/Referees/GetInfo';
    public const registerRefereesApi                = self::sourceApi . 'api/Referees/Register';
    public const ChangeRefereesPassword             = self::sourceApi . 'api/Referees/ResetClientPassword';

    // SportCompanies Api
    public const GetSportCompaniesInfoApi           = self::sourceApi . 'api/SportCompanies/GetInfo';
    public const registerSportCompaniesApi          = self::sourceApi . 'api/SportCompanies/Register';
    public const ChangeSportCompaniesPassword               = self::sourceApi . 'api/SportCompanies/ResetClientPassword';

    // Pages
    public const GetPagesApi                        = self::sourceApi . 'api/Pages';

    // Blocks
    public const GetBlocksApi                       = self::sourceApi . 'api/Blocks';
    public const GetBlockInfoApi                    = self::sourceApi . 'api/Blocks/';
    public const GetBlockCategoriesApi              = self::sourceApi . 'api/Blocks/GetByCategory/';
    public const GetBlockGetPagedByCategoryApi      = self::sourceApi . 'api/Blocks/GetPagedByCategory/';

    // Games
    public const GamesApi                           = self::sourceApi . 'api/Games';
    public const GamesIndexGetApi                   = self::sourceApi . 'api/Games/IndexGet';
    public const GamesGetAllApi                     = self::sourceApi . 'api/Games/GetAll';

    // Platform
    public const PlatformApi                        = self::sourceApi . 'api/Platforms';
    public const PlatformIndexGetApi                = self::sourceApi . 'api/Platforms/IndexGet';
    public const PlatformGetAllApi                  = self::sourceApi . 'api/Platforms/GetAll';

    // Nationalities
    public const NationalitiesIndexGetApi           = self::sourceApi . 'api/Nationalities/IndexGet';
    public const NationalitiesGetAllApi           = self::sourceApi . 'api/Nationalities/GetAll';

    // Countries
    public const CountriesGetAllApi                 = self::sourceApi . 'api/Countries/GetAll';
    public const CountriesIndexGetApi               = self::sourceApi . 'api/Countries/IndexGet';

    // Princedoms
    public const PrincedomsGetAllApi                = self::sourceApi . 'api/Princedoms/GetAll';
    public const PrincedomsIndexGetApi              = self::sourceApi . 'api/Princedoms/IndexGet';

    // Upload
    public const uploadProfilePicApi                = self::sourceApi . 'api/Upload/UploadProfilePic';

    // Events
    public const GetEventsApi                       = self::sourceApi . 'api/Events';
    public const GetEventClassificationsApi         = self::sourceApi . 'api/EventClassifications';
    public const GetClientEventsApi                 = self::sourceApi . 'api/Events/GetClientEvents';
    public const GetEventsByclassificationIdApi     = self::sourceApi . 'api/Events/GetAcceptedBy';
    public const SendClientJoinEventApi             = self::sourceApi . 'api/Events/ClientJoinEvent';
    public const EventOrganizingRequestApi          = self::sourceApi . 'api/Events/EventOrganizingRequest';
    public const EventOrganizingRequestEditApi      = self::sourceApi . 'api/Events/UpdateOrganizingRequest';
    public const EventClassificationsApi            = self::sourceApi . 'api/EventClassifications/GetAll';
    public const GetClientOrgnizingRequestsApi      = self::sourceApi . 'api/Events/GetClientOrgnizingRequests';
    public const GetClientOrgnizingRequestApi       = self::sourceApi . 'api/Events/GetClientOrgnizingRequest';
    public const UpdateOrganizingRequestApi         = self::sourceApi . 'api/Events/UpdateOrganizingRequest';
    public const GetEventsGroupedByDateApi          = self::sourceApi . 'api/Events/GetGroupedByDate?classificationId=';
    public const GetClientJoinRequestApi            = self::sourceApi . 'api/Events/GetClientJoinRequests';
    public const DeleteOrganizingRequestApi         = self::sourceApi . 'api/Events/DeleteOrganizingRequest';
    public const IsCurrentUserInEventApi            = self::sourceApi . 'api/Events/IsCurrentUserInEvent';


    // Articles
    public const GetAllArticlesApi                  = self::sourceApi . 'api/Articles/GetAll';
  //  public const PostArticlesApi                    = self::sourceApi . 'api/Articles';
    public const GetArticlesApi                     = self::sourceApi . 'api/Articles';
    public const GetAllAcceptedAndActiveApi         = self::sourceApi . 'api/Articles/GetAllAcceptedAndActive';
    public const GetClientAcceptedArticlesApi       = self::sourceApi . 'Api/Articles/GetClientAcceptedArticles';
    public const GetClientArticlesApi               = self::sourceApi . 'api/Articles/GetClientArticles';
    public const GetClientArticleApi                = self::sourceApi . 'api/Articles/GetClientArticle/';
    public const CreateClientArticlesApi            = self::sourceApi . 'api/Articles/CreateClientArticle';
    public const UpdateClientArticleApi            = self::sourceApi . 'api/Articles/UpdateClientArticle';
    public const DeleteClientArticleApi            = self::sourceApi . 'api/Articles/DeleteClientArticle';


    // Teams
    public const GetTeamsApi                        = self::sourceApi . 'api/Teams';
    public const UpdateTeamsInfoApi                 = self::sourceApi . 'api/Teams/UpdateInfo';
    public const allTeamsApi                        = self::sourceApi . 'api/Teams/GetAll';
    // get team details for player that is logged in
//    public const GetClientTeamDetailsApi            = self::sourceApi . 'api/Teams/GetClientTeam';
    public const GetPlayerTeamDetailsApi            = self::sourceApi . 'api/Teams/GetPlayerTeam';
    // Get All Teams For Clubs Or Academy depending on the user token
    public const GetClientTeamsApi                = self::sourceApi . 'api/Teams/GetOrgClientTeams';
    public const GetClientTeamDetailsApi          = self::sourceApi . 'api/Teams/GetOrgClientTeam/';
    public const GetOrgClientAcceptedTeamsApi     = self::sourceApi . 'api/Teams/GetOrgClientAcceptedTeams';

    // Teams Request
    public const GetClientTeamRequestsApi           = self::sourceApi . 'api/TeamRequests/GetClientTeamRequests';
    public const PostTeamRequestsApi                = self::sourceApi . 'api/TeamRequests';
    public const GetPlayerInvitationsApi            = self::sourceApi . 'api/TeamRequests/GetPlayerInvitations';
    public const PlayerAcceptInvitationApi          = self::sourceApi . 'api/TeamRequests/SetPlayerState/';

    // NationalTeams
    public const GetNationalTeamsApi                = self::sourceApi . 'api/NationalTeams';
    public const GetNationalTeamsGamesApi           = self::sourceApi . 'api/NationalTeams/GetNationalTeamsGames';
    public const GetNationalByGameApi               = self::sourceApi . 'api/NationalTeams/GetByGame';
    public const GetByNationalTeamApi               = self::sourceApi . 'api/NationalTeamCategories/GetByNationalTeam';
    public const GetByNationalTeamDetailsApi        = self::sourceApi . 'api/NationalTeamCategories';

    // EducationLevels
    public const GetEducationLevelsIndexApi         = self::sourceApi . 'api/EducationLevels/IndexGet';
    public const EducationLevelsGetAllApi           = self::sourceApi . 'api/EducationLevels/GetAll';
    public const GetEducationLevelsTranslationApi   = self::sourceApi . 'api/EducationLevels/GetTranslation/';


    // online services Requests
    public const SendNoProblemRequestApi           = self::sourceApi . 'api/NonObjectionLetterRequests/CreateClientRequest';
    public const GetNoProblemRequestApi            = self::sourceApi . 'api/NonObjectionLetterRequests';
    public const GetALLNoProblemRequestsApi        = self::sourceApi . 'api/NonObjectionLetterRequests/GetAll';
    public const GetClientRequestsApi              = self::sourceApi . 'api/NonObjectionLetterRequests/GetClientRequests';
    public const GetClientRequestApi               = self::sourceApi . 'api/NonObjectionLetterRequests/GetClientRequest';
    public const DeleteClientRequestApi            = self::sourceApi . 'api/NonObjectionLetterRequests/DeleteClientRequest';
    public const UpdateNoProblemRequestApi         = self::sourceApi . 'api/NonObjectionLetterRequests/UpdateClientRequest';


    public const GetALCertificateRequestsApi       = self::sourceApi . 'api/CertificateRequests/GetAll';
    public const CertificateRequestsApi            = self::sourceApi . 'api/CertificateRequests';
    public const SendCertificateRequestApi         = self::sourceApi . 'api/CertificateRequests/CreateClientRequest';
    public const UpdateCertificateRequestApi       = self::sourceApi . 'api/CertificateRequests/UpdateClientRequest';
    public const GetClientCertificateRequestApi    = self::sourceApi . 'api/CertificateRequests/GetClientRequest';
    public const GetClientCertificateRequestsApi   = self::sourceApi . 'api/CertificateRequests/GetClientRequests';
    public const DeleteCertificateRequestApi       = self::sourceApi . 'api/CertificateRequests/DeleteClientRequest';

    public const OrganizationRequestsApi           = self::sourceApi . 'api/OrganizationRequests';
    public const GetOrganizationRequestLevelsApi   = self::sourceApi . 'api/OrganizationRequestLevels/GetAll';
    public const GetOrganizationRequestTypesApi    = self::sourceApi . 'api/OrganizationRequestTypes/GetAll';
    public const GetClientOrganizationRequestsApi  = self::sourceApi . 'api/OrganizationRequests/GetClientRequests';

    public const PlayersUpdateInfoApi              = self::sourceApi . 'api/Players/UpdateInfo';
    public const ClubsUpdateInfoApi                = self::sourceApi . 'api/Clubs/UpdateInfo';
    public const CoachesUpdateInfoApi              = self::sourceApi . 'api/Coaches/UpdateInfo';
    public const AcademiesUpdateInfoApi            = self::sourceApi . 'api/Academies/UpdateInfo';
    public const RefereesUpdateInfoApi             = self::sourceApi . 'api/Referees/UpdateInfo';
    public const WebSiteFollowersUpdateInfoApi     = self::sourceApi . 'api/WebSiteFollowers/UpdateInfo';
    public const SportCompaniesUpdateInfoApi       = self::sourceApi . 'api/SportCompanies/UpdateInfo';

    public const EducationLevelsApi                = self::sourceApi . 'api/EducationLevels/IndexGet';

    // get menus
    public const GetMenuesApi                      = self::sourceApi . 'api/menues';

    // Club Delete Player, Manager and Coach
    public const ClubDeletePlayerApi               = self::sourceApi . 'api/Clubs/DeletePlayer';
    public const ClubDeleteCoachApi                = self::sourceApi . 'api/Clubs/DeleteCoach';
    public const ClubDeleteManagerApi              = self::sourceApi . 'api/Clubs/DeleteManager';

    // Academy Delete Player, Manager and Coach
    public const AcademyDeletePlayerApi            = self::sourceApi . 'api/Academies/DeletePlayer';
    public const AcademyDeleteCoachApi             = self::sourceApi . 'api/Academies/DeleteCoach';
    public const AcademyDeleteManagerApi           = self::sourceApi . 'api/Academies/DeleteManager';
}
