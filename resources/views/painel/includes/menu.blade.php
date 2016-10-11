<div class="menu-painel col-md-2">
    <ul class="menu-painel-ul">
        <li>
            <a href="{{url('/painel/')}}"> Dashboard</a>
        </li>
        <li>
            <a href="{{url('/perfil/'.Auth::user()->user)}}"></i> Meu Perfil</a>
        </li>
        <li>
            <a href="{{url('/painel/meus-livros')}}"> Meus Livros</a>
        </li>
        <li>
            <a href="{{url('/painel/leitura')}}"> Leituras</a>
        </li>
        <li>
            <a href="{{url('/painel/estante/')}}"> Incluir Livros</a>
        </li>
        <li>
            <a href="{{url('/painel/emprestimo')}}"> Emprestimos</a>
        </li>
        
        <!-- verificar se é o administrador, nesse caso o usuario gleidson -->
        <!--@if(Auth::user()->user=="gleidson")   descomntar a linha 40 endif -->   

        <li>
            <a href="{{url('/painel/genero')}}">Assuntos</a>
        </li>
        <li>
            <a href="{{url('/painel/autor')}}">Autores</a>
        </li>
        <li>
            <a href="{{url('/painel/editora')}}">Editoras</a>
        </li>      
        <li>
            <a href="{{url('/painel/livro')}}"> Livros</a>
        </li>
        <li>
            <a href="{{url('/painel/loja')}}">Lojas</a>
        </li>
        <!--@endif-->
        <li>
            <a href="{{url('logout')}}"> Sair</a>
        </li>
    </ul>
</div>