<template>
  <div>
    <!--template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Profile
      </h2>
    </template-->

    <div>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div v-if="$page.props.jetstream.canUpdateProfileInformation">
          <update-profile-information-form :user="$page.props.user" />

          <jet-section-border />
        </div>

        <div v-if="$page.props.jetstream.canUpdatePassword">
          <update-password-form class="mt-10 sm:mt-0" :user="$page.props.user"/>

          <jet-section-border />
        </div>

        <!--div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
          <two-factor-authentication-form class="mt-10 sm:mt-0" />

          <jet-section-border />
        </div-->

        <!--logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0" /-->

        <!--template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
          <jet-section-border />

          <delete-user-form class="mt-10 sm:mt-0" />
        </template-->
      </div>
    </div>
  </div>
</template>

<script>    
    //import DeleteUserForm from './DeleteUserForm'
    //import LogoutOtherBrowserSessionsForm from './LogoutOtherBrowserSessionsForm'
    //import TwoFactorAuthenticationForm from './TwoFactorAuthenticationForm'
    //import AppLayout from '@/Layouts/AppLayout'
    import Layout from "@/Layouts/AppLayout";
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import UpdatePasswordForm from './UpdatePasswordForm'
    import UpdateProfileInformationForm from './UpdateProfileInformationForm'

    export default {      
        props: ['sessions'],
        layout: Layout,
        components: {          
            //DeleteUserForm,
            //LogoutOtherBrowserSessionsForm,
            //TwoFactorAuthenticationForm,
            //AppLayout,
            JetSectionBorder,
            UpdatePasswordForm,
            UpdateProfileInformationForm,
        },
    }
</script>
